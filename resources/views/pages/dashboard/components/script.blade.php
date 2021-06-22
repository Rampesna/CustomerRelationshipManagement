<script src="{{ asset('assets/bundles/fullcalendarscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar/locale/tr.js') }}"></script>

<script>

    const months = [
        'Ocak',
        'Şubat',
        'Mart',
        'Nisan',
        'Mayıs',
        'Haziran',
        'Temmuz',
        'Ağustos',
        'Eylül',
        'Ekim',
        'Kasım',
        'Aralık',
    ];

    var SelectedCompany = $("#SelectedCompany");

    var CreateNoteButton = $("#CreateNoteButton");
    var CreateMeetingButton = $("#CreateMeetingButton");

    var UpdateNoteButton = $("#UpdateNoteButton");
    var UpdateMeetingButton = $("#UpdateMeetingButton");

    var CreateMeetingModalTrigger = $("#CreateMeetingModalTrigger");
    var CreateNoteModalTrigger = $("#CreateNoteModalTrigger");

    var CreateMeetingUsers = $("#create_meeting_users");
    var EditMeetingUsers = $("#edit_meeting_users");

    CreateMeetingModalTrigger.click(function () {
        $("#create_meeting_company_id").val(SelectedCompany.val()).selectpicker('refresh');
        $("#create_meeting_title").val('');
        $("#create_meeting_description").val('');
        $("#create_meeting_type").val(0).selectpicker('refresh');
        $("#create_meeting_address").val('');
        $("#create_meeting_users").val([]).selectpicker('refresh');
        $("#CreateMeetingModal").modal('show');
    });

    CreateNoteModalTrigger.click(function () {
        $("#create_note_title").val('');
        $("#create_note_description").val('');
        $("#create_note_global").val(0).selectpicker('refresh');
        $("#create_note_company_id").val(SelectedCompany.val()).selectpicker('refresh');
        $("#CreateNoteModal").modal('show');
    });

    CreateNoteButton.click(function () {
        var company_id = $("#create_note_company_id").val();
        var user_id = '{{ auth()->user()->id() }}';
        var title = $("#create_note_title").val();
        var date = $("#create_note_date").val();
        var description = $("#create_note_description").val();
        var global = $("#create_note_global").val();

        saveNote({
            company_id: company_id,
            user_id: user_id,
            title: title,
            date: date,
            description: description,
            global: global,
        }, 0);
    });

    UpdateNoteButton.click(function () {
        var id = $("#note_id_edit").val();
        var company_id = $("#edit_note_company_id").val();
        var user_id = '{{ auth()->user()->id() }}';
        var title = $("#edit_note_title").val();
        var date = $("#edit_note_date").val();
        var description = $("#edit_note_description").val();
        var global = $("#edit_note_global").val();

        saveNote({
            id: id,
            company_id: company_id,
            user_id: user_id,
            title: title,
            date: date,
            description: description,
            global: global,
        }, 1);
    });

    function saveNote(data, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.note.save') }}',
            data: data,
            success: function () {
                toastr.success('Not Başarıyla Kaydedildi');
                if (direction === 0) {
                    $("#CreateNoteModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditNoteModal").modal('hide');
                }
                calendar.fullCalendar('refetchEvents');
            },
            error: function (error) {
                toastr.success('Not Kaydedilirken Sistemsel Bir Hata Oluştu!');
                console.log(error)
            }
        });
    }

    CreateMeetingButton.click(function () {
        var company_id = $("#create_meeting_company_id").val();
        var user_id = '{{ auth()->user()->id() }}';
        var title = $("#create_meeting_title").val();
        var description = $("#create_meeting_description").val();
        var start_date = $("#create_meeting_start_date").val();
        var end_date = $("#create_meeting_end_date").val();
        var type = $("#create_meeting_type").val();
        var address = $("#create_meeting_address").val();
        var users = $("#create_meeting_users").val();

        saveMeeting({
            company_id: company_id,
            user_id: user_id,
            title: title,
            description: description,
            start_date: start_date,
            end_date: end_date,
            type: type,
            address: address,
            users: users,
        }, 0);
    });

    UpdateMeetingButton.click(function () {
        var id = $("#meeting_id_edit").val();
        var company_id = $("#edit_meeting_company_id").val();
        var user_id = '{{ auth()->user()->id() }}';
        var title = $("#edit_meeting_title").val();
        var description = $("#edit_meeting_description").val();
        var start_date = $("#edit_meeting_start_date").val();
        var end_date = $("#edit_meeting_end_date").val();
        var type = $("#edit_meeting_type").val();
        var address = $("#edit_meeting_address").val();
        var users = $("#edit_meeting_users").val();

        saveMeeting({
            id: id,
            company_id: company_id,
            user_id: user_id,
            title: title,
            description: description,
            start_date: start_date,
            end_date: end_date,
            type: type,
            address: address,
            users: users,
        }, 1);
    });

    function saveMeeting(data, direction) {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.meeting.save') }}',
            data: data,
            success: function () {
                toastr.success('Toplantı Başarıyla Kaydedildi');
                if (direction === 0) {
                    $("#CreateMeetingModal").modal('hide');
                } else if (direction === 1) {
                    $("#EditMeetingModal").modal('hide');
                }
                calendar.fullCalendar('refetchEvents');
            },
            error: function (error) {
                toastr.success('Toplantı Kaydedilirken Sistemsel Bir Hata Oluştu!');
                console.log(error)
            }
        });
    }

    function reformatDate(date) {
        var formattedDate = new Date(date);
        return String(formattedDate.getDate()).padStart(2, '0') + '.' +
            String(formattedDate.getMonth()).padStart(2, '0') + '.' +
            formattedDate.getFullYear() + ', ' +
            String(formattedDate.getHours()).padStart(2, '0') + ':' +
            String(formattedDate.getMinutes()).padStart(2, '0') + ' ';
    }

    function reformatDateForCalendar(date) {
        var formattedDate = new Date(date);
        return formattedDate.getFullYear() + '-' +
            String(formattedDate.getMonth() + 1).padStart(2, '0') + '-' +
            String(formattedDate.getDate()).padStart(2, '0') + 'T' +
            String(formattedDate.getHours()).padStart(2, '0') + ':' +
            String(formattedDate.getMinutes()).padStart(2, '0') + ':00';
    }

    function getUsers() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.all') }}',
            data: {},
            success: function (users) {
                CreateMeetingUsers.empty();
                EditMeetingUsers.empty();
                $.each(users, function (index) {
                    CreateMeetingUsers.append(`<option value="${users[index].id}">${users[index].name}</option>`);
                    EditMeetingUsers.append(`<option value="${users[index].id}">${users[index].name}</option>`);
                });
                CreateMeetingUsers.selectpicker('refresh');
                EditMeetingUsers.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    getUsers();

    var calendar = $('#calendar').fullCalendar({
        defaultView: 'month',
        lang: {
            month: 'Ay'
        },
        header: {
            left: 'month, agendaWeek, listMonth, _prev, _next, today',
            center: '',
            right: 'title',
        },
        contentHeight: 'auto',
        defaultDate: '{{ date('Y-m-d') }}',
        editable: false,
        eventLimit: false,
        nowIndicator: true,
        displayEventTime: false,
        customButtons: {
            _next: {
                text: 'İleri',
                click: function () {
                    calendar.fullCalendar('next');
                }
            },
            _prev: {
                text: 'Geri',
                click: function () {
                    calendar.fullCalendar('prev');
                }
            }
        },

        dayClick: function (date, jsEvent, view) {
            $("#ModalSelector").modal('show');
            $("#create_note_date").val(date.format('YYYY-MM-DD') + 'T12:00');
            $("#create_meeting_start_date").val(date.format('YYYY-MM-DD') + 'T12:30');
            $("#create_meeting_end_date").val(date.format('YYYY-MM-DD') + 'T13:30');
        },

        loading: function (isLoading, view) {
            if (isLoading) {

            }
        },

        eventClick: function (calEvent, jsEvent, view) {
            if (calEvent.type === 'note') {
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.note.show') }}',
                    data: {
                        id: calEvent.note_id
                    },
                    success: function (note) {
                        if (note.user_id != '{{ auth()->user()->id() }}') {
                            $("#show_note_title").html(note.title);
                            $("#show_note_description").html(note.description);
                            $("#ShowNoteModal").modal('show');
                        } else {
                            $("#note_id_edit").val(note.id);
                            $("#edit_note_title").val(note.title);
                            $("#edit_note_date").val(reformatDateForCalendar(note.date));
                            $("#edit_note_company_id").val(note.company_id).selectpicker('refresh');
                            $("#edit_note_global").val(note.global).selectpicker('refresh');
                            $("#edit_note_description").val(note.description);
                            $("#EditNoteModal").modal('show');
                        }
                    },
                    error: function (error) {
                        toastr.error('Not Detayları Alınırken Sistemsel Bir Hata Oluştu!');
                        console.log(error);
                    }
                });
            } else if (calEvent.type === 'meeting') {
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.meeting.show') }}',
                    data: {
                        id: calEvent.meeting_id
                    },
                    success: function (meeting) {
                        console.log(meeting)
                        if (meeting.user_id != '{{ auth()->user()->id() }}') {
                            $("#show_meeting_title").html(meeting.title);
                            $("#show_meeting_description").html(meeting.description);
                            $("#ShowMeetingModal").modal('show');
                        } else {
                            $("#meeting_id_edit").val(meeting.id);
                            $("#edit_meeting_company_id").val(meeting.company_id).selectpicker('refresh');
                            $("#edit_meeting_title").val(meeting.title);
                            $("#edit_meeting_description").val(meeting.description);
                            $("#edit_meeting_start_date").val(reformatDateForCalendar(meeting.start_date));
                            $("#edit_meeting_end_date").val(reformatDateForCalendar(meeting.end_date));
                            $("#edit_meeting_type").val(meeting.type).selectpicker('refresh');
                            $("#edit_meeting_address").val(meeting.address);
                            $("#edit_meeting_users").val($.map(meeting.users, function(user) { return user["id"]; })).selectpicker('refresh');
                            $("#EditMeetingModal").modal('show');
                        }
                    },
                    error: function (error) {
                        toastr.error('Toplantı Detayları Alınırken Sistemsel Bir Hata Oluştu!');
                        console.log(error);
                    }
                });
            } else if (calEvent.type === 'opportunity') {
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.opportunity.showDetail') }}',
                    data: {
                        id: calEvent.opportunity_id
                    },
                    success: function (opportunity) {
                        console.log(opportunity)
                        $("#show_opportunity_name").html(opportunity.name ?? '--');
                        $("#show_opportunity_date").html(opportunity.date ? reformatDate(opportunity.date) : '');
                        $("#show_opportunity_company").html(opportunity.company ? opportunity.company.name : '--');
                        $("#show_opportunity_user").html(opportunity.user ? opportunity.user.name : '--');
                        $("#show_opportunity_email").html(opportunity.email ?? '--');
                        $("#show_opportunity_phone_number").html(opportunity.phone_number ?? '--');
                        $("#show_opportunity_website").html(opportunity.website ?? '--');
                        $("#show_opportunity_foundation_date").html(opportunity.foundation_date ? reformatDate(opportunity.foundation_date) : '--');
                        $("#show_opportunity_manager_name").html(opportunity.manager_name ?? '--');
                        $("#show_opportunity_manager_email").html(opportunity.manager_email ?? '--');
                        $("#show_opportunity_manager_phone_number").html(opportunity.manager_phone_number ?? '--');
                        $("#show_opportunity_price_and_currency").html(opportunity.price ? opportunity.price + ' ' + opportunity.currency : '--');
                        $("#show_opportunity_priority").html(opportunity.priority ? opportunity.priority.name : '--');
                        $("#show_opportunity_access_type").html(opportunity.access_type ? opportunity.access_type.name : '--');
                        $("#show_opportunity_domestic").html(opportunity.domestic === 0 ? 'Yerli' : 'Yabancı');
                        $("#show_opportunity_country").html(opportunity.country ? opportunity.country.name : '--');
                        $("#show_opportunity_province").html(opportunity.province ? opportunity.province.name : '--');
                        $("#show_opportunity_district").html(opportunity.district ? opportunity.district.name : '--');
                        $("#show_opportunity_estimated_result_and_type").html(opportunity.estimated_result ? opportunity.estimated_result + ' ' + opportunity.estimated_result_type.name : '--');
                        $("#show_opportunity_capacity_and_type").html(opportunity.capacity ? opportunity.capacity + ' ' + opportunity.capacity_type.name : '--');
                        $("#show_opportunity_status").html(opportunity.status ? opportunity.status.name : '--');
                        $("#ShowOpportunityModal").modal('show');
                    },
                    error: function (error) {
                        toastr.error('Fırsat Detayları Alınırken Sistemsel Bir Hata Oluştu!');
                        console.log(error);
                    }
                });
            } else if (calEvent.type === 'activity') {
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.activity.show') }}',
                    data: {
                        id: calEvent.activity_id
                    },
                    success: function (activity) {
                        console.log(activity)
                        $("#ShowActivityModal").modal('show');
                    },
                    error: function (error) {
                        toastr.error('Aktivite Detayları Alınırken Sistemsel Bir Hata Oluştu!');
                        console.log(error);
                    }
                });
            } else if (calEvent.type === 'offer') {
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.offer.show') }}',
                    data: {
                        id: calEvent.offer_id
                    },
                    success: function (offer) {
                        console.log(offer)
                        $("#ShowOfferModal").modal('show');
                    },
                    error: function (error) {
                        toastr.error('Teklif Detayları Alınırken Sistemsel Bir Hata Oluştu!');
                        console.log(error);
                    }
                });
            }
        },

        events: function (start, end, timezone, callback) {
            $.ajax({
                url: '{{ route('ajax.dashboard.calendar') }}',
                dataType: 'json',
                data: {
                    start_date: start.format("YYYY-MM-DD"),
                    end_date: end.format("YYYY-MM-DD"),
                    company_id: SelectedCompany.val(),
                    auth_user_id: '{{ auth()->user()->id() }}',
                    timezone: timezone
                },
                success: function (response) {

                    console.log(response)

                    var events = [];

                    $.each(response.notes, function (index) {
                        events.push({
                            _id: response.notes[index].id,
                            id: response.notes[index].id,
                            title: `${response.notes[index].title}`,
                            start: reformatDateForCalendar(response.notes[index].date),
                            end: reformatDateForCalendar(response.notes[index].date),
                            url: 'javascript:void(0)',
                            type: 'note',
                            className: `fc-event-solid-warning`,
                            note_id: `${response.notes[index].id}`
                        });
                    });

                    $.each(response.meetings, function (index) {
                        events.push({
                            _id: response.meetings[index].id,
                            id: response.meetings[index].id,
                            title: `${response.meetings[index].title}`,
                            start: reformatDateForCalendar(response.meetings[index].start_date),
                            end: reformatDateForCalendar(response.meetings[index].end_date),
                            url: 'javascript:void(0)',
                            type: 'meeting',
                            className: `fc-event-solid-primary`,
                            meeting_id: `${response.meetings[index].id}`
                        });
                    });

                    $.each(response.opportunities, function (index) {
                        events.push({
                            _id: response.opportunities[index].id,
                            id: response.opportunities[index].id,
                            title: `${response.opportunities[index].name}`,
                            start: reformatDateForCalendar(response.opportunities[index].date),
                            end: reformatDateForCalendar(response.opportunities[index].date),
                            url: 'javascript:void(0)',
                            type: 'opportunity',
                            className: `fc-event-solid-info`,
                            opportunity_id: `${response.opportunities[index].id}`
                        });
                    });

                    $.each(response.activities, function (index) {
                        events.push({
                            _id: response.activities[index].id,
                            id: response.activities[index].id,
                            title: `${response.activities[index].subject}`,
                            start: reformatDateForCalendar(response.activities[index].start_date),
                            end: reformatDateForCalendar(response.activities[index].end_date),
                            url: 'javascript:void(0)',
                            type: 'activity',
                            className: `fc-event-solid-success`,
                            activity_id: `${response.activities[index].id}`
                        });
                    });

                    $.each(response.offers, function (index) {
                        events.push({
                            _id: response.offers[index].id,
                            id: response.offers[index].id,
                            title: `${response.offers[index].subject}`,
                            start: reformatDateForCalendar(response.offers[index].created_at),
                            end: reformatDateForCalendar(response.offers[index].created_at),
                            url: 'javascript:void(0)',
                            type: 'offer',
                            className: `fc-event-solid-dark-75`,
                            offer_id: `${response.offers[index].id}`
                        });
                    });

                    callback(events);
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }
    });

    var opportunityDateSpan = $("#opportunityDateSpan");
    var opportunityCreatedAndTargetSpan = $("#opportunityCreatedAndTargetSpan");
    var opportunityRateSpan = $("#opportunityRateSpan");
    var opportunityRateProgressBar = $("#opportunityRateProgressBar");

    var activityDateSpan = $("#activityDateSpan");
    var activityCreatedAndTargetSpan = $("#activityCreatedAndTargetSpan");
    var activityRateSpan = $("#activityRateSpan");
    var activityRateProgressBar = $("#activityRateProgressBar");

    var lastActivities = $("#lastActivities");

    function index() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.dashboard.index') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (response) {
                opportunityDateSpan.html(response.opportunity.date);
                opportunityCreatedAndTargetSpan.html(`${response.opportunity.created}/${response.opportunity.target}`);
                opportunityRateSpan.html(`${parseFloat(response.opportunity.target === 0 ? '100' : (response.opportunity.created * 100 / response.opportunity.target)).toFixed(2)}%`);
                opportunityRateProgressBar.css({
                    width: `${response.opportunity.target === 0 ? '100' : (response.opportunity.created * 100 / response.opportunity.target)}%`
                });

                activityDateSpan.html(response.activity.date);
                activityCreatedAndTargetSpan.html(`${response.activity.created}/${response.activity.target}`);
                activityRateSpan.html(`${parseFloat(response.activity.target === 0 ? '100' : (response.activity.created * 100 / response.activity.target)).toFixed(2)}%`);
                activityRateProgressBar.css({
                    width: `${response.opportunity.target === 0 ? '100' : (response.opportunity.created * 100 / response.opportunity.target)}%`
                });

                lastActivities.html('');
                $.each(response.activity.lastActivities, function (index) {
                    lastActivities.append(`
                    <div class="timeline-item align-items-start">
                        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">${reformatDate(response.activity.lastActivities[index].created_at)}</div>
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-success icon-xxl"></i>
                        </div>
                        <div class="timeline-content text-dark-50">
                            (${response.activity.lastActivities[index].relation_type == 'App\\Models\\Opportunity' ? 'Fırsat' : (response.activity.lastActivities[index].relation_type == 'App\\Models\\Customer' ? 'Müşteri' : '')}) - ${response.activity.lastActivities[index].subject}
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                toastr.error('Veriler Alınırken Bir Sorun Oluştu!');
                console.log(error);
            }
        });
        calendar.fullCalendar('refetchEvents');
    }

    index();

    SelectedCompany.change(function () {
        index();
    });

    setInterval(function () {
        index();
    }, 5000);
</script>
