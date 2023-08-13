@extends('base.layout')

@section('title', 'BHV/ERO')

@section('content')
    <section class="about-section">
        <div class="auto-container">
            <div class="form-type-radio mt-n5 mb-5">
                <a class="switch-link theme-btn btn-one {{ isset($_GET['event']) ? ($_GET['event'] == 'camp' ? 'active' : '') : '' }}"
                   href="{{ route('bhv', ['event' => 'camp']) }}">Camp</a>
                <a class="switch-link theme-btn ml-3 btn-one {{ isset($_GET['event']) ? $_GET['event'] == 'bbq' ? 'active' : '' : '' }}"
                   href="{{ route('bhv', ['event' => 'bbq']) }}">Barbecue</a>
            </div>
            @if(isset($_GET['event']) && $_GET['event'] == 'bbq')
                <h5><b>Introductory Barbecue</b></h5>
                <table class="table mt-4">
                    <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Diet</th>
                    <th>Remarks</th>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\ParticipantCamp::all() as $participant)
                        <tr>
                            <td>{{ $participant->first_name }}</td>
                            <td>{{ $participant->last_name }}</td>
                            <td>{{ $participant->phone_number }}</td>
                            <td>{{ $participant->dietary_requirements }}</td>
                            <td>{{ $participant->remarks }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h5><b>Introductory Camp</b></h5>
                <table class="table mt-4">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Emergency Contact</th>
                        <th>Emergency Phone Number</th>
                        <th>Diet</th>
                        <th>Remarks</th>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\ParticipantCamp::all() as $participant)
                            <tr>
                                <td>{{ $participant->first_name }}</td>
                                <td>{{ $participant->last_name }}</td>
                                <td>{{ $participant->phone_number }}</td>
                                <td>{{ $participant->emergency_contact_name }}</td>
                                <td>{{ $participant->emergency_contact_phone }}</td>
                                <td>{{ $participant->dietary_requirements }}</td>
                                <td>{{ $participant->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

@endsection
