<?php

namespace Larawise\Authify\Concerns;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasDepartments
{
    /**
     * Determine if the given department is the current department.
     *
     * @param mixed $department
     *
     * @return bool
     */
    public function isCurrentDepartment($department)
    {
        return $department->id === $this->department->id;
    }

    /**
     * Switch the user's context to the given department.
     *
     * @param mixed $department
     *
     * @return bool
     */
    public function switchDepartment($department)
    {
        if (! $this->belongsToTeam($department)) {
            return false;
        }

        $this->forceFill([
            'department_id' => $department->id,
        ])->save();

        $this->setRelation('department', $department);

        return true;
    }

    /**
     * Determine if the user belongs to the given department.
     *
     * @param mixed $department
     *
     * @return bool
     */
    public function belongsToTeam($department)
    {
        if (is_null($department)) {
            return false;
        }

        return $this->ownsTeam($department) || $this->teams->contains(function ($d) use ($department) {
                return $d->id === $department->id;
            });
    }

    /**
     * Get the department associated with the user.
     *
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(UserDepartment::class, 'id', 'department_id');
    }



}
