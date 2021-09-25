<script>

    var SelectedCompany = $('#SelectedCompany');

    var FilterButton = $('#FilterButton');
    var opportunityStatuses = $('#opportunity_statuses');
    var activityMeetingReasons = $('#activity_meeting_reasons');

    "use strict";

    const primary = '#6993FF';
    const success = '#1BC5BD';
    const info = '#8950FC';
    const warning = '#FFA800';
    const danger = '#F64E60';

    const opportunityPieChartDiv = "#opportunityPieChartDiv";
    var opportunityPieChartOptions = {
        series: [],
        chart: {
            width: 700,
            height: 400,
            type: 'pie',
        },
        legend: {
            show: true,
            position: 'right'
        },
        labels: [],
        colors: [primary, success, warning, danger, info]
    };
    var opportunityPieChart = new ApexCharts(document.querySelector(opportunityPieChartDiv), opportunityPieChartOptions);
    opportunityPieChart.render();

    const activityPieChartDiv = "#activityPieChartDiv";
    var activityPieChartOptions = {
        series: [],
        chart: {
            width: 700,
            height: 400,
            type: 'pie',
        },
        legend: {
            show: true,
            position: 'right'
        },
        labels: [],
        colors: [primary, success, warning, danger, info]
    };
    var activityPieChart = new ApexCharts(document.querySelector(activityPieChartDiv), activityPieChartOptions);
    activityPieChart.render();

    const timelineChartDiv = "#timelineChartDiv";
    var timelineChartOptions = {
        series: [{
            name: 'series1',
            data: [31, 40, 28, 51, 42, 109, 100]
        }, {
            name: 'series2',
            data: [11, 32, 45, 32, 34, 52, 41]
        }],
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',
            categories: [
                "2018-09-19T00:00:00.000Z",
                "2018-09-19T01:30:00.000Z",
                "2018-09-19T02:30:00.000Z",
                "2018-09-19T03:30:00.000Z",
                "2018-09-19T04:30:00.000Z",
                "2018-09-19T05:30:00.000Z",
                "2018-09-19T06:30:00.000Z"
            ]
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
        colors: [primary, success]
    };
    var timelineChart = new ApexCharts(document.querySelector(timelineChartDiv), timelineChartOptions);
    timelineChart.render();

    function getOpportunityStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.opportunityStatuses') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (statuses) {
                opportunityStatuses.empty();
                $.each(statuses, function (i, status) {
                    opportunityStatuses.append(`<option value="${status.id}">${status.name}</option>`);
                });
                opportunityStatuses.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getActivityMeetingReasons() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.definition.activityMeetingReasons') }}',
            data: {
                company_id: SelectedCompany.val()
            },
            success: function (meetingReasons) {
                activityMeetingReasons.empty();
                $.each(meetingReasons, function (i, meetingReason) {
                    activityMeetingReasons.append(`<option value="${meetingReason.id}">${meetingReason.name}</option>`);
                });
                activityMeetingReasons.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getReport() {
        $('#loader').fadeIn(250);
        var opportunity_statuses = opportunityStatuses.val();
        var activity_meeting_reasons = activityMeetingReasons.val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.dashboard.report') }}',
            data: {
                company_id: SelectedCompany.val(),
                opportunity_statuses: opportunity_statuses,
                activity_meeting_reasons: activity_meeting_reasons,
                start_date: start_date,
                end_date: end_date
            },
            success: function (response) {
                var opportunityPieChartLabels = [];
                var opportunityPieChartSeries = [];

                var activityPieChartLabels = [];
                var activityPieChartSeries = [];

                var timelineChartCategories = [];
                var timelineChartSeriesOpportunityData = [];
                var timelineChartSeriesActivityData = [];

                $.each(response.opportunityStatuses, function (i, opportunityStatus) {
                    opportunityPieChartLabels.push(opportunityStatus.name);
                    opportunityPieChartSeries.push(Object.keys(opportunityStatus.opportunities).length);
                });
                $.each(response.activityMeetingReasons, function (i, activityMeetingReason) {
                    activityPieChartLabels.push(activityMeetingReason.name);
                    activityPieChartSeries.push(Object.keys(activityMeetingReason.activities).length);
                });
                $.each(response.dates, function (i, date) {
                    timelineChartCategories.push(date.date);
                    timelineChartSeriesOpportunityData.push(date.opportunities_count);
                    timelineChartSeriesActivityData.push(date.activities_count);
                });
                opportunityPieChart.updateOptions({
                    labels: opportunityPieChartLabels,
                    series: opportunityPieChartSeries
                });
                activityPieChart.updateOptions({
                    labels: activityPieChartLabels,
                    series: activityPieChartSeries
                });
                timelineChart.updateOptions({
                    xaxis: {
                        categories: timelineChartCategories
                    },
                    series: [
                        {
                            name: 'Fırsat',
                            data: timelineChartSeriesOpportunityData
                        },
                        {
                            name: 'Aktivite',
                            data: timelineChartSeriesActivityData
                        }
                    ]
                });
                $('#loader').fadeOut(250);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getOpportunityStatuses();
    getActivityMeetingReasons();
    getReport();

    SelectedCompany.change(function () {
        getOpportunityStatuses();
        getActivityMeetingReasons();
        getReport();
    });

    FilterButton.click(function () {
        getReport();
    });
</script>
