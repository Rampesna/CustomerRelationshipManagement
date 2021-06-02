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

    function reformatDate(date) {
        var formattedDate = new Date(date);
        return String(formattedDate.getDate()).padStart(2, '0') + '.' +
            String(formattedDate.getMonth()).padStart(2, '0') + '.' +
            formattedDate.getFullYear() + ', ' +
            String(formattedDate.getHours()).padStart(2, '0') + ':' +
            String(formattedDate.getMinutes()).padStart(2, '0') + ' ';
    }

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

        },

        loading: function (isLoading, view) {
            if (isLoading) {

            }
        },

        eventClick: function (calEvent, jsEvent, view) {

        },

        events: function (start, end, timezone, callback) {
            callback([]);
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
            data: {},
            success: function (response) {
                console.log(response)

                opportunityDateSpan.html(response.opportunity.date);
                opportunityCreatedAndTargetSpan.html(`${response.opportunity.created}/${response.opportunity.target}`);
                opportunityRateSpan.html(`${response.opportunity.target === 0 ? '100' : (response.opportunity.created * 100 / response.opportunity.target)}%`);
                opportunityRateProgressBar.css({
                    width: `${response.opportunity.target === 0 ? '100' : (response.opportunity.created * 100 / response.opportunity.target)}%`
                });

                activityDateSpan.html(response.activity.date);
                activityCreatedAndTargetSpan.html(`${response.activity.created}/${response.activity.target}`);
                activityRateSpan.html(`${response.activity.target === 0 ? '100' : (response.activity.created * 100 / response.activity.target)}%`);
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
                        <div class="timeline-content text-dark-50">(${response.activity.lastActivities[index].relation_type == 'App\\Models\\Opportunity' ? 'Fırsat' : (response.activity.lastActivities[index].relation_type == 'App\\Models\\Customer' ? 'Müşteri' : '')}) - ${response.activity.lastActivities[index].subject}</div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                toastr.error('Veriler Alınırken Bir Sorun Oluştu!');
                console.log(error);
            }
        });
    }

    index();
</script>
