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
        $members = $guild ? $guild->members : new Collection;
        $availableGuilds = $guild ? new Collection : $this->guilds->with('leader')->orderBy('name', 'ASC')->get();

        return view('guild.index', compact(['user', 'guild', 'members', 'availableGuilds']));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha|unique:guilds'
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

}
