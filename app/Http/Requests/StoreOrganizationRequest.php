<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Prepare the input before validation.
     *
     * Users can enter:
     *
     * fuoye.com.ng
     * www.fuoye.com.ng
     * https://fuoye.com.ng
     * http://fuoye.com.ng
     *
     * The application will normalize them to:
     *
     * https://fuoye.com.ng
     */
    protected function prepareForValidation(): void
    {
        $website = trim((string) $this->input('website'));

        if ($website !== '') {

            // Remove any existing protocol first.
            $website = preg_replace(
                '/^https?:\/\//i',
                '',
                $website
            );

            // Remove accidental leading/trailing slashes.
            $website = trim($website, " /");

            // Add HTTPS automatically.
            $website = 'https://' . $website;

        } else {

            $website = null;

        }

        $this->merge([
            'website' => $website,
        ]);
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],

            'country' => [
                'nullable',
                'string',
                'max:100',
            ],

            'state' => [
                'nullable',
                'string',
                'max:100',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}