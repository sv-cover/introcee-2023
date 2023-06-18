<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @mixin Eloquent
 */
class ParticipantBarbecue extends Model
{
    use HasUuids;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'email_address', 'phone_number', 'student_number', 'membership_id', 'field_of_study', 'study_year', 'dietary_requirements', 'remarks', 'first_year', 'senior', 'herocee', 'candidate_board', 'board', 'photocee', 'paid', 'paid_at', 'payment_reference', 'fee', 'final_fee', 'mentor', 'terms_and_conditions'];

    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'participants_barbecue';

}
