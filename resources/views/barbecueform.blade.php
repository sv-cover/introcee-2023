<section class="contact-section" id="form">
    <div class="auto-container">
        <div class="form-inner">
            @if($coverApi->cover_session_logged_in() &&
                \App\Models\ParticipantBarbecue::where([
									['membership_id', $coverApi->get_cover_session()->id],
									['confirmed', true]
									])->first())
                <div class="activities-section">
                    <div class="lower-box justify-content-center">
                        <div class="sec-title light mt-0 ">
                            <span class="sub-title">You are already signed up for the barbecue!</span>
                        </div>
                    </div>
                </div>
            @elseif(\App\Http\Controllers\BarbecueController::isFull())
                <div class="activities-section">
                    <div class="lower-box justify-content-center">
                        <div class="sec-title light mt-0 ">
                            <span class="sub-title">Unfortunately, the sign-ups for the barbecue are full!</span>
                        </div>
                    </div>
                </div>
            @elseif(0 == 1)
                <div class="activities-section">
                    <div class="lower-box justify-content-center">
                        <div class="sec-title light mt-0 ">
                            <span class="sub-title">The sign-ups are not open yet. Keep an eye on the website to find out when they will open!</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="form-type-radio mt-n5 mb-5">
                    <a class="switch-link theme-btn btn-one {{ $type != 'senior' ? 'active' : '' }}"
                       href="{{ url('/barbecue?type=first_year#form') }}">I am a first-year student</a>
                    <a class="switch-link theme-btn ml-3 btn-one {{ $type == 'senior' ? 'active' : '' }}"
                       href="{{ url('/barbecue?type=senior#form') }}">I am a senior student</a>
                </div>
                @if($type != 'senior')
                    <form method="POST" action="{{ route('bbqregistration.firstyear') }}" id="first-year-form"
                          class="default-form">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 sec-title">
                                <span class="sub-title mb-n3">Personal Information</span>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label>First name</label>
                                <input type="text" name="first_name" placeholder="Ex: Jan" required>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label>Last name</label>
                                <input type="text" name="last_name" placeholder="Ex: de Joker" required>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" placeholder="Ex: Date of Birth" required>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                <label>Email address</label>
                                <input type="email" name="email_address" placeholder="Ex: j.de.joker@student.rug.nl"
                                       required>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                <label>Phone number</label>
                                <input type="text" name="phone_number" placeholder="Ex: +3160000000" required>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                <label>Student number</label>
                                <input type="text" name="student_number" placeholder="Ex: s0000000" required>
                            </div>
                            <div class="col-12 sec-title">
                                <span class="sub-title mb-n3">Other</span>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>Field of Study</label>
                                <select name="field_of_study" required="required">
                                    <option value="">Select Study</option>
                                    <option value="AI">Artificial Intelligence</option>
                                    <option value="CS">Computing Science</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>Dietary requirements</label>
                                <input type="text" name="dietary_requirements" placeholder="Ex: Vegetarian">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label>Remarks</label>
                                <textarea name="remarks"
                                          placeholder="Ex: allergies, medications, remarks"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions"
                                       required
                                       checked/>
                                <label for="terms_and_conditions">I have read and agree to the&nbsp;<a href="https://filemanager.svcover.nl/uploads/introcee/terms-and-conditions-2023.pdf">terms
                                        and
                                        conditions</a>.</label>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 text-center">
                                <button class="theme-btn btn-one" type="submit" name="submit-form"><span>Proceed to payment (€3.5)</span>
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('bbqregistration.senior') }}" id="senior-form"
                          class="default-form">
                        @if($coverApi->cover_session_logged_in())
                            @php
                                $member = $coverApi->get_cover_session();
                                $last_name = $member->tussenvoegsel ? $member->tussenvoegsel . ' ' . $member->achternaam : $member->achternaam;
                            @endphp
                            @csrf
                            <div class="row clearfix">
                                <div class="col-12 sec-title">
                                    <span class="sub-title mb-n3">Personal Information</span>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                    <label>First name</label>
                                    <input type="text" name="first_name" placeholder="Ex: Jan" required
                                           value="{{ $member->voornaam }}">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                    <label>Last name</label>
                                    <input type="text" name="last_name" placeholder="Ex: de Joker" required
                                           value="{{ $last_name }}">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" placeholder="Ex: Date of Birth" required
                                           value="{{ $member->geboortedatum }}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email_address"
                                           placeholder="Ex: j.de.joker@student.rug.nl"
                                           required value="{{ $member->email }}">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Phone number</label>
                                    <input type="text" name="phone_number" placeholder="Ex: +3160000000" required
                                           value="{{ $member->telefoonnummer }}">
                                </div>
                                <div class="col-12 sec-title">
                                    <span class="sub-title mb-n3">Other</span>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                    <label>Field of Study</label>
                                    <select name="field_of_study" required="required">
                                        <option value="">Select Study</option>
                                        <option value="AI">Artificial Intelligence</option>
                                        <option value="CS">Computing Science</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                    <label>Study Year (at the BBQ)</label>
                                    <input type="number" min="1" max="10" name="study_year" required
                                           placeholder="Ex: 2"
                                           value="{{ (date("Y") - $member->beginjaar) + 1 }}">
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                    <label>&nbsp;</label>
                                    <input type="checkbox" name="mentor" id="mentor"/>
                                    <label for="mentor">I am a mentor</label>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Dietary requirements</label>
                                    <input type="text" name="dietary_requirements" placeholder="Ex: Vegetarian">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks"
                                              placeholder="Ex: allergies, medications, remarks"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="remarks font-italic mb-3"><small>P.S. We are automatically filling in
                                            if
                                            you
                                            are a member of a support committee (Board/Candidate
                                            Board/IntroCee/HEROCee/PhotoCee), you do not need to mention
                                            this.</small>
                                    </p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions"
                                           required
                                           checked/>
                                    <label for="terms_and_conditions">I have read and agree to the&nbsp;<a href="https://filemanager.svcover.nl/uploads/introcee/terms-and-conditions-2023.pdf">terms
                                            and conditions</a>.</label>
                                </div>
                                <input type="hidden" name="membership_id" value="{{ $member->id }}"/>
                                <input type="hidden" name="candidate_board"
                                       value="{{ $coverApi->cover_session_in_committee('candy') }}"/>
                                <input type="hidden" name="herocee"
                                       value="{{ $coverApi->cover_session_in_committee('herocee') }}"/>
                                <input type="hidden" name="photocee"
                                       value="{{ $coverApi->cover_session_in_committee('photocee') }}"/>
                                <input type="hidden" name="introcee"
                                       value="{{ $coverApi->cover_session_in_committee('introcee') }}"/>
                                <input type="hidden" name="board"
                                       value="{{ $coverApi->cover_session_in_committee('board') }}"/>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 text-center">
                                    <button class="theme-btn btn-one" type="submit" name="submit-form">Proceed to payment (€3.5)
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="activities-section">
                                <div class="lower-box">
                                    <div class="sec-title light mt-0">
                                        <span class="sub-title">LOG IN</span>
                                    </div>
                                    <div class="text">
                                        <p>We associate registrations with Cover accounts, so please log in.</p>
                                    </div>
                                    <div class="support-box">
                                        <a href="{{ $coverApi->cover_login_url(url('/barbecue?type=senior#form')) }}"
                                           class="theme-btn btn-one">Log In</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                @endif
            @endif
        </div>
    </div>
</section>
