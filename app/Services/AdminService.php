<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Models\Admin;
use Exception;

class AdminService {

    /**
     * @var $admin
     */
    protected $admin;

    /**
     * AdminService constructor.
     *
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }


    /**
     * Get all admin.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->admin->get();
    }

    /**
     * Get admin by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->admin->where('id', $id)->get();
    }

    /**
     * Validate admin data.
     * Store to DB if there are no errors.
     *
     * @param array $attributes
     * @return String
     */
    public function create(array $attributes): string
    {
        $user = new $this->admin;

        $validator = Validator::make($attributes, [
            'name'     => 'bail|min:2',
            'email'    => 'bail|max:255',
            'password' => 'bail|min:6',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $user->name     = $attributes['name'];
        $user->email    = $attributes['email'];
        $user->password = $attributes['password'];
        $user->save();

        return $user->fresh();
    }

    /**
     * Delete admin by id.
     *
     * @param $id
     * @return String
     */
    public function delete($id): string
    {
        DB::beginTransaction();
        try {
            $user = $this->admin->whereId($id);
            $user->delete();

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete admin data');
        }

        DB::commit();

        return $user;
    }

    /**
     * update admin record.
     *
     * @return string
     */
    public function update(array $data, int $id): string
    {
        $validator = Validator::make($data, [
            'name'     => 'bail|min:2',
            'email'    => 'bail|max:255',
            'password' => 'bail|min:6',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $user        = $this->admin->whereId($id);
            $user->name  = $data['name'];
            $user->email = $data['email'];
            $user->update();

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update admin data');
        }

        DB::commit();

        return $user;
    }
}
