@extends('backend.__layouts.master')

@section('backend')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Student Account</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ url('/') }}" class="text-muted text-hover-primary">{{ isset($title) ? $title : '||'}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Student</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Student Info</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            <!--begin::details View-->
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Student Details</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('admin.student.high.update', $user->id) }}" enctype="multipart/form-data" class="form">
                        @csrf
                        <!-- Role -->
                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                        <!-- User Type -->
                        <input type="hidden" name="user_type_id" value="{{ $usertype->id}}">
                        <!-- School_id -->
                        <input type="hidden" name="school_id" value="{{ $school->id}}">
                        
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6"><b>Avatar</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url({{ isset($user->image) ? url('storage/images/users/' . $user->image) : url('storage/images/no_image.jpg') }});" alt=""></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">
                                    <b>Full Name:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="first_name"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                            value="{{ $user->first_name }}" placeholder="Your First Name...." />
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" 
                                            value="{{ $user->last_name }}" placeholder="Your Last Name..." />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required"><b>Date of Birth:</b></span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-2 fv-row d-flex">
                                    @php 
                                        $dob = explode(" ", $user->date_of_birth);
                                    @endphp
                                    <input type="number" name="day" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $dob[0] }}" placeholder="DD" />
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-3 fv-row d-flex">
                                    <!--begin::Input-->
                                    <select name="month" aria-label="Select a Month..." data-control="select2" 
                                        placeholder="Select a Month..." class="form-select form-select-solid form-select-lg">
                                        <option value="">Select an option.</option>
                                        <option value="January" {{ $dob[1] == 'January' ? 'selected="selected"' : '' }} >January</option>
                                        <option value="February" {{ $dob[1] == 'February' ? 'selected="selected"' : '' }} >February</option>
                                        <option value="March" {{ $dob[1] == 'March' ? 'selected="selected"' : '' }} >March</option>
                                        <option value="April" {{ $dob[1] == 'April' ? 'selected="selected"' : '' }}>April</option>
                                        <option value="May" {{ $dob[1] == 'May' ? 'selected="selected"' : '' }}>May</option>
                                        <option value="June" {{ $dob[1] == 'June' ? 'selected="selected"' : '' }}>June</option>
                                        <option value="July" {{ $dob[1] == 'July' ? 'selected="selected"' : '' }}>July</option>
                                        <option value="August" {{ $dob[1] == 'August' ? 'selected="selected"' : '' }}>August</option>
                                        <option value="September" {{ $dob[1] == 'September' ? 'selected="selected"' : '' }}>September</option>
                                        <option value="October" {{ $dob[1] == 'October' ? 'selected="selected"' : '' }}>October</option>
                                        <option value="November" {{ $dob[1] == 'November' ? 'selected="selected"' : '' }}>November</option>
                                        <option value="December" {{ $dob[1] == 'December' ? 'selected="selected"' : '' }}>December</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-3 fv-row d-flex">
                                    <input type="number" name="year" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $dob[2] }}" min="1900" placeholder="2022" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Gender:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <!--begin::Input-->
                                    <select name="gender" aria-label="Select a Gender" data-control="select2" 
                                    data-placeholder="Select a Gender..." class="form-select form-select-solid form-select-lg">
                                        <option value="">Select a Gender.</option>
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected="selected"' : '' }} >Male</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected="selected"' : '' }} >Female</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Phone Number:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="phone" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->phone }}" placeholder="+263 (0) 782 123123" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Email:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->email }}" placeholder="abc@example.come" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6"><b>Address:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="address" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->address }}"placeholder="Address"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6"><b>Nationality:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="nationality" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->nationality }}" placeholder="eg. Zimbabwean etc."/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6"><b>Religion:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="religion" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->religion }}" placeholder="eg. Christian etc."/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                             <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                   <b>Id Number:</b>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row d-flex">
                                    <input type="text" name="id_number"  class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->id_number }}" placeholder="63-04576 Z 05" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Card title-->
                            <div class="card-title m-0 mt-3">
                                <h3 class="fw-bolder m-0">Health Condition </h3>
                            </div>
                            <!--end::Card title-->
                            <hr>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                   <b>Allergy:</b>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row d-flex">
                                    <input type="text" name="allergy" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->health->allergy }}" placeholder="eg. Flower Allergy etc." />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                   <b>Illness:</b>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row d-flex">
                                    <input type="text" name="illness" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->health->illness }}" placeholder="eg. Asthma etc." />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Card title-->
                            <div class="card-title m-0 mt-3 mb-6">
                                <h3 class="fw-bolder m-0">Parent or Guardian</h3>
                            </div>
                            <!--end::Card title-->
                            <hr>

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                   <b>Sponsor:</b>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row d-flex">
                                     <!--begin::Input-->
                                    <select name="sponsor" aria-label="Select Sponsor" data-control="select2" 
                                      data-placeholder="Select Sponsor..." class="form-select form-select-solid form-select-lg">
                                        <option value="">Select Sponsor.</option>
                                        <option value="Parent" {{ $user->student->sponsor == 'Parent' ? 'selected="selected"' : ''}}>Parent</option>
                                        <option value="Guardian" {{ $user->student->sponsor == 'Guardian' ? 'selected="selected"' : ''}}>Guardian</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">
                                    <b>Full Name:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="sponsor_first_name"  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                            value="{{ $user->student->first_name }}" placeholder="Your First Name...." />
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 fv-row">
                                            <input type="text" name="sponsor_last_name" class="form-control form-control-lg form-control-solid" 
                                            value="{{ $user->student->last_name }}"placeholder="Your Last Name..." />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Phone Number:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="sponsor_phone" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->student->phone }}"placeholder="+263 (0) 782 123123" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Email:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="sponsor_email" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->student->email }}" placeholder="abc@example.com" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                   <b>Address:</b>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row d-flex">
                                    <input name="sponsor_address" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->student->address }}"placeholder="12, First Street, Avonlea, Harare"></textarea>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Occupation:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="sponsor_occupation" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->student->occupation }}" placeholder="Managing Director" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6"><b>Company:</b></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="sponsor_company_name" class="form-control form-control-lg form-control-solid" 
                                    value="{{ $user->student->company_name }}" placeholder="Old Mutual" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->

                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                           
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Update</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
            <!--end::details View-->


            
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>



@endsection