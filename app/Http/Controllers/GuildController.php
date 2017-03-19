<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use App\Guild;

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
        $user = $this->guard->user();
        $guild = $user->guild;

        return $guild ? $this->renderGuildDashboard($guild) : $this->renderGuildIndex();
    }

    protected function renderGuildIndex()
    {
        $availableGuilds = $this->guilds->with('leader')->orderBy('name', 'ASC')->get();

        return view('guilds.index', compact('availableGuilds'));
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
            'name' => 'required|alpha|unique:guilds'
        ], [
            'name.required' => 'O nome da guild é obrigatório',
            'name.alpha' => 'O nome da guild deve conter somente letras',
            'name.unique' => 'O nome da guild deve ser único'
        ]);

        $user = $this->guard->user();
        $guild = $this->guilds->newInstance([
            'name' => $request->name,
            'leader_id' => $user->id
        ]);

        $guild->save();
        $user->guild()->associate($guild)->save();

        return redirect()->back();
    }

    public function apply($guildId)
    {
        $guild = $this->guilds->with('leader', 'candidates')->findOrFail($guildId);
        $user = $this->guard->user();

        if (! $guild->candidates->find($user->id)) {
            $guild->candidates()->save($user);
        }

        return redirect()->back()
            ->withMessage("Sua aplicação foi enviada para {$guild->leader->nickname}, líder da $guild->name.");
    }

}
