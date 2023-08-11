<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        $today = new DateTime();
        $bday = new DateTime($this->date_of_birth);
        return $today->diff($bday)->y;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'participant');
    }

    public function getWallet(): ?Wallet
    {
        return Wallet::where('email', $this->email_address)->first();
    }
}
