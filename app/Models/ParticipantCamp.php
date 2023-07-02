<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @mixin Eloquent
 */
class ParticipantCamp extends Model
{
    use HasUuids;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'email_address', 'phone_number', 'student_number', 'membership_id', 'emergency_contact_name', 'emergency_contact_phone', 'field_of_study', 'study_year', 'dietary_requirements', 'remarks', 'first_year', 'senior', 'herocee', 'candidate_board', 'board', 'photocee', 'paid', 'paid_at', 'payment_reference', 'fee', 'final_fee', 'mentor', 'terms_and_conditions'];

    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'participants_camp';

    public function getAge(){
        $camp_start = new DateTime('2023-09-08');
        $camp_end = new DateTime('2023-09-10');
        $bday = new DateTime($this->date_of_birth);
        return $camp_start->diff($bday)->y;
    }

}
