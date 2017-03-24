<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class GuildController extends Controller
{
    protected $guard;

    protected $guilds;

    public function __construct(Guild $guilds, Guard $guard)
    {
        $this->guilds = $guilds;
        $this->guard = $guard;
    }

    public function index()
    {
        $guild = $this->guard->user()->guild;

        return $guild ? $this->renderGuildDashboard($guild) : $this->renderGuildIndex();
    }

    protected function renderGuildIndex()
    {
        $availableGuilds = $this->guilds->with('leader')->orderBy('name', 'ASC')->get();
        $applications = $this->guard->user()->applications;

        return view('guilds.index', compact('availableGuilds', 'applications'));
    }

    protected function renderGuildDashboard($guild)
    {
        $members = $guild->members;
        $candidates = $guild->candidates;

        return view('guilds.dashboard', compact(['guild', 'members', 'candidates']));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha|unique:guilds',
        ], [
            'name.required' => 'O nome da guild é obrigatório',
            'name.alpha'    => 'O nome da guild deve conter somente letras',
            'name.unique'   => 'O nome da guild deve ser único',
        ]);

        $user = $this->guard->user();

        if ($user->gold < $this->getGuildCost()) {
            return redirect()->back()
                ->withError('Você não tem dinheiro para fundar uma guild.');
        }

        $user->gold -= $this->getGuildCost();

        $guild = $this->guilds->newInstance([
            'name'      => $request->name,
            'leader_id' => $user->id,
        ]);

        $guild->save();
        $user->guild()->associate($guild)->save();
        $user->applications()->detach();
        $user->save();

        return redirect()->back();
    }

    public function apply($guildId)
    {
        $guild = $this->guilds->with('leader', 'candidates')->findOrFail($guildId);
        $user = $this->guard->user();

        if ($user->guild_id) {
            return redirect()->back()
                ->withMessage('Você já está em uma guild.');
        }

        if (!$guild->candidates->find($user->id)) {
            $guild->candidates()->save($user);
        }

        return redirect()->back()
            ->withMessage("Sua aplicação foi enviada para {$guild->leader->nickname}, líder da $guild->name.");
    }

    public function accept($userId)
    {
        $user = $this->guard->user();
        $guild = $user->guild;

        if ($guild->leader_id != $user->id) {
            return redirect()->back()
                ->withError('Você não é o líder da guild');
        }

        if (!$candidate = $guild->candidates->find($userId)) {
            return redirect()->back()
                ->withError('Esse usuário não é um candidato');
        }

        if ($candidate->guild_id) {
            return redirect()->back()
                ->withError('Esse usuário já está em uma guild');
        }

        $candidate->guild()->associate($guild)->save();
        $guild->candidates()->detach($userId);
        $candidate->applications()->detach();

        return redirect()->back()
            ->withMessage($candidate->nickname.' foi aceito.');
    }

    public function decline($userId)
    {
        $user = $this->guard->user();
        $guild = $user->guild;

        if ($guild->leader_id != $user->id) {
            return redirect()->back()
                ->withError('Você não é o líder da guild');
        }

        if (!$candidate = $guild->candidates->find($userId)) {
            return redirect()->back()
                ->withError('Esse usuário não é um candidato');
        }

        $guild->candidates()->detach($userId);

        return redirect()->back()
            ->withMessage($candidate->nickname.' foi negado como membro.');
    }

    public function getGuildCost()
    {
        return 10000;
    }
}
