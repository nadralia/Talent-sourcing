<?php

namespace App\Services;

use App\Models\Business;

class BusinessService {
 /**
     * @var $business
     */
    protected $business;

    /**
     * businessService constructor.
     *
     * @param Business $business
     */
    public function __construct(Business $business)
    {
        $this->business = $business;
    }


    /**
     * Get all business.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->business->get();
    }

    /**
     * Get business by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->business->where('id', $id)->get();
    }


    /**
     * Validate business data.
     * Store to DB if there are no errors.
     *
     * @param array $attributes
     * @return String
     */
    public function create(array $attributes): string
    {

        $business_instance = new $this->business;

        $validator = Validator::make($attributes, [
            'email' => 'bail|max:255',
            'password' => 'bail|min:6',
            'size'=> 'bail|min:2',
            'phone'=> 'bail|min:12',
        ]);



        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        
        $business_instance->email = $attributes['email'];
        $business_instance->password = $attributes['password'];
        $business_instance->size = $attributes['size'];
        $business_instance->phone = $attributes['phone'];

        $business_instance->save();

        return $business_instance->fresh();
    }

    /**
     * Delete business by id.
     *
     * @param $id
     * @return String
     */
    public function delete($id): string
    {
        DB::beginTransaction();
        try {
            $business_instance = $this->business->whereId($id);
            $business_instance->delete();

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete business data');
        }

        DB::commit();

        return $business_instance;
    }

    /**
     * update business record.
     *
     * @return string
     */
    public function update(array $data, int $id): string
    {

        $validator = Validator::make($data, [
            
            'email' => 'bail|max:255',
            'size' => 'bail|min:2',
            'phone' => 'bail|min:2',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $business_instance = $this->business->whereId($id);
            $business_instance->size = $data['size'];
            $business_instance->email = $data['email'];
            $business_instance->phone = $data['phone'];
            $business_instance->update();

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update business data');
        }

        DB::commit();

        return $business_instance;
    }
}

