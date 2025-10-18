<?php

namespace Larawise\Authify\Concerns;

use Larawise\Authify\Authify;

trait HasTeams
{
    /**
     * Determine if the given team is the current team.
     *
     * @param mixed $team
     *
     * @return bool
     */
    public function isCurrentTeam($team)
    {
        return optional($this->currentTeam)->id === $team->id;
    }

    /**
     * Get the current team of the user's context.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentTeam()
    {
        if (is_null($this->current_team_id) && $this->id) {
            $this->switchTeam($this->personalTeam());
        }

        return $this->belongsTo(Authify::model('team'), 'current_team_id');
    }

    /**
     * Switch the user's context to the given team.
     *
     * @param mixed $team
     *
     * @return bool
     */
    public function switchTeam($team)
    {
        if (! $this->belongsToTeam($team)) {
            return false;
        }

        $this->forceFill([
            'current_team_id' => $team->id,
        ])->save();

        $this->setRelation('currentTeam', $team);

        return true;
    }

    /**
     * Get all the teams the user owns or belongs to.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allTeams()
    {
        return $this->ownedTeams->merge($this->teams)->sortBy('name');
    }

    /**
     * Get all the teams the user owns.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedTeams()
    {
        return $this->hasMany(Authify::model('team'));
    }

    /**
     * Get all the teams the user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Authify::model('team'), Jetstream::membershipModel())
            ->withPivot('role')
            ->withTimestamps()
            ->as('membership');
    }

    /**
     * Get the user's "personal" team.
     *
     * @return \Larawise\Authify\Models\Team
     */
    public function personalTeam()
    {
        return $this->ownedTeams->firstWhere('personal_team', true);
    }

    /**
     * Determine if the user owns the given team.
     *
     * @param mixed $team
     *
     * @return bool
     */
    public function ownsTeam($team)
    {
        return $team && $this->id === $team->{$this->getForeignKey()};
    }

    /**
     * Determine if the user belongs to the given team.
     *
     * @param mixed $team
     *
     * @return bool
     */
    public function belongsToTeam($team)
    {
        if (! $team) {
            return false;
        }

        return $this->ownsTeam($team)
            || $this->teams()->where('id', $team->id)->exists();
    }
}
