<?php include("datastream.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Report Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

    <style>
    body {
        color: black;
    }


    body.dark-mode {
        background-color: #152028;
    }

    /* Toggle button styles */
    .toggle-button {
        position: fixed;
        top: 10px;
        right: 10px;
        background-color: white;
        color: #152028;
        /* padding:6px 12px; */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        outline: none;
        font-size: 0.75rem;
    }


    .toggle-button.dark-mode {
        background-color: #152028;
        color: white;
        style: none;
    }

    #layout-wrapper>div>div.page-content>div>div:nth-child(3)>div>div>div.card-header>h4>span {
        padding: 1.5rem;
        font-size: 1.5rem;
    }


    .blink {
        animation: blink 1s steps(1, end) infinite;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
    </style>
</head>

<body data-topbar="light" data-layout="horizontal">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="toggle-button btn-sm" onclick="toggleDarkMode()">Toggle Dark Mode</div>
            <div class="page-content">
                <div class="container-fluid" id="data">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card overflow-hidden">
                                <div class="bg-primary bg-soft">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-primary p-3">
                                                <h5 class="text-primary">Welcome Back !</h5>
                                                <p>Askari Reports</p>
                                            </div>
                                        </div>
                                        <div class="col-5 align-self-end">
                                            <img src="assets/images/logo.png" alt="" class="img-fluid" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-4">
                                                <img src="<?php echo $logo; ?>" alt=""
                                                    class="img-thumbnail rounded-circle" height="100" width="100" />
                                            </div>
                                            <h5 class="font-size-15 text-truncate"><?php echo implode('', $user); ?>
                                            </h5>
                                            <p class="text-muted mb-0 text-truncate"><?php echo implode('', $site); ?>
                                            </p>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15"><?php echo implode('', $guards); ?>
                                                        </h5>
                                                        <p class="text-muted mb-0">Total Guards</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="font-size-15"><?php echo implode('', $patrols); ?>
                                                        </h5>
                                                        <p class="text-muted mb-0">Total patrols</p>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <a href="https://staging.askari.optitech.co.ke/login"
                                                        class="btn btn-primary waves-effect waves-light btn-sm">Login
                                                        Client Panel
                                                        <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Total Checkpoint Summary</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="text-muted">Today</p>
                                            <h3 class="text"><?php echo implode('', $checkpoint); ?></h3>
                                            <p class="text-muted">
                                                <span class="text-success me-2">
                                                    Total points <i class="mdi mdi-arrow-up"></i>
                                                </span>
                                                to be checked
                                            </p>

                                            <div class="mt-4">
                                                <a href="#" class="btn btn-primary waves-effect waves-light btn-sm">View
                                                    More <i class="mdi mdi-arrow-right ms-1"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mt-4 mt-sm-0">
                                                <div id="radialchart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Patrol Summary</p>
                                                    <h4 class="mb-0">
                                                        <?php echo implode('', $elapsed); ?>/<?php echo implode('', $patrols); ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                        <span class="avatar-title">
                                                            <i class="bx bx-copy-alt font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">
                                                        Attendance Summary
                                                    </p>
                                                    <h4 class="mb-0">
                                                        <?php echo implode('', $attendance); ?>/<?php echo implode('', $guards); ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-archive-in font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Tasks Summary</p>
                                                    <h4 class="mb-0">
                                                        <?php echo implode('', $completed); ?>/<?php echo implode('', $incomplete); ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-wrap">
                                        <h4 class="card-title mb-4">Todays Patrol Summary</h4>
                                        <div class="ms-auto">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Today</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div id="barchart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-5">Todays Tasks</h4>
                                    <ul class="verti-timeline list-unstyled">
                                        <?php foreach ($tasks as $task) { ?>
                                        <li class="event-list active">
                                            <div class="event-timeline-dot">
                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <h5 class="font-size-14">
                                                        <?php echo date("Hi", strtotime($task['from'])); ?>hrs
                                                        <i
                                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                                    </h5>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div><?php echo $task['title']; ?></div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="text-center mt-4">
                                        <a href="javascript: void(0);"
                                            class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                                class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-5">Todays Incidents</h4>
                                    <ul class="verti-timeline list-unstyled">
                                        <?php foreach ($incidents as $incident) { ?>
                                        <li class="event-list active">
                                            <div class="event-timeline-dot">
                                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <h5 class="font-size-14">
                                                        <?php echo date("Hi", strtotime($incident['time'])); ?>hrs
                                                        <i
                                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                                    </h5>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div><?php echo $incident['title']; ?></div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="text-center mt-4">
                                        <a href="javascript: void(0);"
                                            class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                                class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">

                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="bx bx-map-pin text-primary display-4"></i>
                                        </div>
                                        <h3 class="text"><?php echo substr($hours['total_hours'], 0, 2); ?></h3>
                                        <p>Total Logged Hours Today</p>
                                    </div>
                                    <div id="attendance-summary">
                                        <div class="table-responsive mt-4">
                                            <table class="table align-middle table-nowrap" id="live-patrol-table">
                                                <tbody id="table-body">
                                                    <?php foreach ($records as $record) { ?>
                                                    <tr>
                                                        <td style="width: 30%">
                                                            <p class="mb-0">
                                                                <?php echo $allguards[$record['guard_id']]; ?></p>
                                                        </td>
                                                        <td style="width: 25%">
                                                            <h5 class="mb-0"><?php
                                                                                    //get time now
                                                                                    date_default_timezone_set(implode('', $timezone));
                                                        $now = date('Y-m-d H:i:s');

                                                        // get difference between time now and time in
                                                        $time1 = $record['time_in'] == null ? strtotime($now) : strtotime($record['time_in']);
                                                        $time2 = $record['time_out'] == null ? strtotime($now) : strtotime($record['time_out']);
                                                        $diff = $time2 - $time1;
                                                        $hours = round($diff / (60 * 60), 2);
                                                        echo $hours;
                                                        ?></h5>
                                                        </td>
                                                        <td>
                                                            <div class="progress bg-transparent progress-sm">
                                                                <div class="progress-bar bg-primary rounded"
                                                                    role="progressbar"
                                                                    style="width: <?php echo $hours * (100 / 12); ?>%"
                                                                    aria-valuenow="94" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="map" style="width: 100%; height: 30vh"></div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title mb-4">Live Patrols <span class="blink"><img
                                                src="http://cliparts.co/cliparts/6Tp/5aB/6Tp5aB97c.png" alt=""
                                                width="16" height="16"></span></h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-info table-hover table-sm">
                                        <thead>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text">Site</span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text">Tag</span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text">Date</span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text">Time</span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text">Status</span></th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($livepatrols as $livepatrol) { ?>
                                            <tr>
                                                <td class="table-sm"><?php echo $allguards[$livepatrol['guard_id']]; ?>
                                                </td>
                                                <td class="table-sm"><?php echo $allsites[$livepatrol['site_id']]; ?>
                                                </td>
                                                <td class="table-sm"><?php echo $alltags[$livepatrol['tag_id']]; ?></td>
                                                <td class="table-sm"><?php echo $livepatrol['date']; ?></td>
                                                <td class="table-sm"><?php echo $livepatrol['time']; ?></td>
                                                <td class="table-sm">
                                                    <span
                                                        class="badge bg-success"><?php echo $livepatrol['status']; ?></span>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                            document.write(new Date().getFullYear());
                            </script>
                            © Askari.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block"></div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">
                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images" />
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked />
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images" />
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" />
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images" />
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" />
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images" />
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch" />
                    <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                </div>
            </div>
        </div>
        <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <script src="assets/js/app.js"></script>


    <script>
    let allguards = <?php echo json_encode($allguards); ?>;
    let allsites = <?php echo json_encode($allsites); ?>;
    let alltags = <?php echo json_encode($alltags); ?>;

    // Update the live patrol table
    function updateLivePatrolTable() {
        $.ajax({
            url: 'livepatrols.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var tableBody = $('#data > div:nth-child(3) > div > div > div.card-body > table > tbody');

                // Clear the existing table rows
                tableBody.empty();
                // Iterate over the collection of data
                $.each(response.patrols, function(index, item) {
                    var tableRow = '<tr>' +
                        '<td class="table-sm">' + allguards[item.guard_id] + '</td>' +
                        '<td class="table-sm">' + allsites[item.site_id] + '</td>' +
                        '<td class="table-sm">' + alltags[item.tag_id] + '</td>' +
                        '<td class="table-sm">' + item.date + '</td>' +
                        '<td class="table-sm">' + item.time + '</td>' +
                        '<td class="table-sm">' +
                        '<span class="badge bg-success">' + item.status + '</span>' +
                        '</td>' +
                        '</tr>';

                    // Append the table row inside the table body
                    tableBody.append(tableRow);
                });
            }
        });
    }

    // Update the live patrol table immediately
    updateLivePatrolTable();

    // Update the live patrol table every 5 seconds
    setInterval(updateLivePatrolTable, 5000);
    </script>
    <script>
    function updateAttendanceTable() {
        // Make an AJAX request
        $.ajax({
            url: 'livepatrols.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const tableBody = document.querySelector('#table-body');

                // Clear the existing table rows
                tableBody.innerHTML = '';

                // Iterate over the updated records and create table rows dynamically
                response.attendance.records.forEach(record => {
                    const newRow = document.createElement('tr');

                    // Create and populate the first column
                    const guardNameCell = document.createElement('td');
                    const guardNameParagraph = document.createElement('p');
                    guardNameParagraph.textContent = allguards[record.guard_id];
                    guardNameCell.appendChild(guardNameParagraph);
                    newRow.appendChild(guardNameCell);

                    // Create and populate the second column (time difference)
                    const hoursCell = document.createElement('td');
                    const hoursHeading = document.createElement('h5');

                    // Get the current time
                    const now = new Date();

                    // Calculate the time difference
                    const timeIn = record.time_in ? parseTimeString(record.time_in) : now;
                    const timeOut = record.time_out ? parseTimeString(record.time_out) : now;
                    const diff = Math.abs(timeOut - timeIn);

                    // Convert the time difference to hours with two decimal places
                    const hours = (diff / (1000 * 60 * 60)).toFixed(2);

                    // Display the calculated hours
                    hoursHeading.textContent = hours;
                    hoursCell.appendChild(hoursHeading);
                    newRow.appendChild(hoursCell);

                    // Create and populate the third column (progress bar)
                    const progressBarCell = document.createElement('td');
                    const progressBar = document.createElement('div');
                    progressBar.className = 'progress bg-transparent progress-sm';
                    const progressBarInner = document.createElement('div');
                    progressBarInner.className = 'progress-bar bg-primary rounded';

                    // Calculate the width of the progress bar
                    const progressBarWidth = (hours * 100) / 12;
                    progressBarInner.style.width = `${progressBarWidth}%`;

                    progressBar.appendChild(progressBarInner);
                    progressBarCell.appendChild(progressBar);
                    newRow.appendChild(progressBarCell);

                    // Function to parse time string in HH:mm:ss format
                    function parseTimeString(timeString) {
                        const [hours, minutes, seconds] = timeString.split(':');
                        return new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours,
                            minutes, seconds);
                    }


                    // Append the new row to the table body
                    tableBody.appendChild(newRow);
                });
            }
        });
    }

    // Update the live patrol table immediately
    updateAttendanceTable();

    // Update the live patrol table every 5 seconds
    setInterval(updateAttendanceTable, 5000);
    </script>



    <script>
    // Get the current time
    var now = new Date();

    // Loop through each <li> element in the timeline
    var liElements = document.querySelectorAll(".verti-timeline li");
    for (var i = 0; i < liElements.length; i++) {
        var liElement = liElements[i];

        // Get the time specified in the <h5> element
        var timeString = liElement.querySelector("h5").innerText.trim();
        var time = new Date();
        time.setHours(timeString.substring(0, 2));
        time.setMinutes(timeString.substring(2, 4));

        // If the current is within the specific hour , add the 'active' class to the <li> element and the 'bx-fade-right' class to the <i> element
        if (now.getHours() == time.getHours()) {
            liElement.classList.add("active");
            liElement.querySelector("i").classList.add("bx-fade-right");
        }

    }
    </script>
    <script>
    // create radial bar chart
    var average = <?= json_encode($average) ?>;
    var options = {

        chart: {
            height: 200,
            type: "radialBar",
        },
        series: [average > 100 ? 100 : average.toFixed(2)],
        colors: ["#20E647"],
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 0,
                    size: "70%",
                    background: "#293450"
                },
                track: {
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 4,
                        opacity: 0.15
                    }
                },
                dataLabels: {
                    name: {
                        offsetY: -10,
                        color: "#fff",
                        fontSize: "10px"
                    },
                    value: {
                        color: "#fff",
                        fontSize: "15px",
                        show: true
                    }
                }
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                gradientToColors: ["#FF5733", "#FFA500", "FFF00", "#90EE90", "#008000"],
                stops: [0, 25, 75, 100]
            }
        },
        stroke: {
            lineCap: "round"
        },
        labels: ["Progress"],
        title: {
            text: 'Scanned Points',
            align: 'bottom',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: '#263238'
            },
        }

    };


    var chart = new ApexCharts(
        document.querySelector("#radialchart"),
        options
    );
    chart.render();


    // create distributed column chart
    var colors = ["#00e639", "#e60000", "#e6e600"];

    var options1 = {
        series: [{
            data: [<?= json_encode(implode('', $scanned)) ?>, 0, <?= json_encode($upcoming) ?>]
        }],
        chart: {
            height: 350,
            type: 'bar',
            events: {
                click: function(chart, w, e) {}
            }
        },
        colors: colors,
        plotOptions: {
            bar: {
                columnWidth: '15%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: true
        },
        legend: {
            show: true
        },
        xaxis: {
            categories: <?= json_encode($categories) ?>,
            labels: {
                style: {
                    colors: colors,
                    fontSize: '12px'
                }
            }
        }
    };


    var chart1 = new ApexCharts(
        document.querySelector("#barchart"),
        options1
    );
    chart1.render();
    </script>
    <script>
    // Check for previously set dark mode preference and update the class accordingly
    if (localStorage.getItem('dark-mode') === 'true') {
        document.body.classList.add('dark-mode');
        document.querySelector('.toggle-button').classList.add('dark-mode');
    }

    // Define the chart options for the light mode
    const lightOptions = {
        chart: {
            height: 200,
            type: "radialBar",
        },
        series: [average > 100 ? 100 : average.toFixed(2)],
        colors: ["#20E647"],
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 0,
                    size: "70%",
                    background: "#293450"
                },
                track: {
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 4,
                        opacity: 0.15
                    }
                },
                dataLabels: {
                    name: {
                        offsetY: -10,
                        color: "#fff",
                        fontSize: "10px"
                    },
                    value: {
                        color: "#fff",
                        fontSize: "15px",
                        show: true
                    }
                }
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                gradientToColors: ["#FF5733", "#FFA500", "FFF00", "#90EE90", "#008000"],
                stops: [0, 25, 75, 100]
            }
        },
        stroke: {
            lineCap: "round"
        },
        labels: ["Progress"],
        title: {
            text: 'Scanned Points',
            align: 'bottom',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: '#263238'
            },
        }
    };

    // Define the chart options for the dark mode
    const darkOptions = {
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: false,
                color: '#255aee',
                shadeTo: 'light',
                shadeIntensity: 0.65
            },
        },
        labels: ["Progress"],
        title: {
            text: 'Scanned Points',
            align: 'bottom',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: 'white'
            }
        }
    };

    const lightOptions1 = {
        theme: {
            mode: 'light',
            palette: 'palette1',
            monochrome: {
                enabled: false,
                color: '#255aee',
                shadeTo: 'light',
                shadeIntensity: 0.65
            },
        },
    };

    const darkOptions1 = {
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: false,
                color: '#255aee',
                shadeTo: 'light',
                shadeIntensity: 0.65
            },
        },
    };

    function toggleDarkMode() {
        // Toggle the class on the body and toggle button elements
        document.body.classList.toggle('dark-mode');
        document.querySelector('.toggle-button').classList.toggle('dark-mode');

        //set the default dark mode preference in localStorage
        if (localStorage.getItem('dark-mode') === 'true') {
            localStorage.setItem('dark-mode', false);
        } else {
            localStorage.setItem('dark-mode', true);
        }

        // Update the dark mode preference in localStorage
        localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));

        // Update the chart options based on the dark mode preference
        if (document.body.classList.contains('dark-mode')) {
            chart.updateOptions(darkOptions);
            chart1.updateOptions(darkOptions1);
        } else {
            chart.updateOptions(lightOptions);
            chart1.updateOptions(lightOptions1);
        }


        // Add or remove the text-white and bg-dark classes from all card elements
        var cards = document.querySelectorAll('.card');
        for (var i = 0; i < cards.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                cards[i].classList.add('text-white', 'bg-dark');
            } else {
                cards[i].classList.remove('text-white', 'bg-dark');
            }
        }

        // Add or remove the text-white and bg-dark classes from the footer element
        var footer = document.querySelector('.footer');
        if (document.body.classList.contains('dark-mode')) {
            footer.classList.add('text-white', 'bg-dark');
        } else {
            footer.classList.remove('text-white', 'bg-dark');
        }

        // Add or remove the text-white class from all h3 , h4 and h5 elements

        var h3Elements = document.querySelectorAll('h3');
        for (var i = 0; i < h3Elements.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                h3Elements[i].classList.add('text-white');
            } else {
                h3Elements[i].classList.remove('text-white');
            }
        }

        var h4Elements = document.querySelectorAll('h4');
        for (var i = 0; i < h4Elements.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                h4Elements[i].classList.add('text-white');
            } else {
                h4Elements[i].classList.remove('text-white');
            }
        }

        var h5Elements = document.querySelectorAll('h5');
        for (var i = 0; i < h5Elements.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                h5Elements[i].classList.add('text-white');
            } else {
                h5Elements[i].classList.remove('text-white');
            }
        }

        // Change the class of table from table-info to table-dark and vice versa
        var tables = document.querySelectorAll('table');
        for (var i = 0; i < tables.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                tables[i].classList.add('table-dark');
                tables[i].classList.remove('table-info');
            } else {
                tables[i].classList.remove('table-dark');
                tables[i].classList.add('table-info');
            }
        }



        // Add or remove the text-white class from all p elements with class text-muted
        var mutedParagraphs = document.querySelectorAll('p');
        for (var i = 0; i < mutedParagraphs.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                mutedParagraphs[i].classList.add('text-white');
                mutedParagraphs[i].classList.remove('text-muted');
            } else {
                mutedParagraphs[i].classList.remove('text-white');
                mutedParagraphs[i].classList.add('text-muted');
            }
        }

        // Add or remove the text-white class from all ms-auto elements
        var msAutoElements = document.querySelectorAll('.nav-link');
        for (var i = 0; i < msAutoElements.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                msAutoElements[i].classList.add('text-white');
            } else {
                msAutoElements[i].classList.remove('text-white');
            }
        }


    }

    // Retrieve the dark mode preference from localStorage and set the appropriate classes on page load
    var darkMode = localStorage.getItem('dark-mode');
    if (darkMode === 'true') {
        document.body.classList.add('dark-mode');
        document.querySelector('.toggle-button').classList.add('dark-mode');

        var cards = document.querySelectorAll('.card');
        for (var i = 0; i < cards.length; i++) {
            cards[i].classList.add('text-white', 'bg-dark');
        }
        var footer = document.querySelector('.footer');
        footer.classList.add('text-white', 'bg-dark');

        var h3Elements = document.querySelectorAll('h3');
        for (var i = 0; i < h3Elements.length; i++) {
            h3Elements[i].classList.add('text-white');
        }

        var h4Elements = document.querySelectorAll('h4');
        for (var i = 0; i < h4Elements.length; i++) {
            h4Elements[i].classList.add('text-white');
        }

        var h5Elements = document.querySelectorAll('h5');
        for (var i = 0; i < h5Elements.length; i++) {
            h5Elements[i].classList.add('text-white');
        }

        var mutedParagraphs = document.querySelectorAll('p');
        for (var i = 0; i < mutedParagraphs.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                mutedParagraphs[i].classList.add('text-white');
                mutedParagraphs[i].classList.remove('text-muted');
            } else {
                mutedParagraphs[i].classList.add('text-muted');
                mutedParagraphs[i].classList.remove('text-white');
            }
        }
        var tables = document.querySelectorAll('table');
        for (var i = 0; i < tables.length; i++) {
            if (document.body.classList.contains('dark-mode')) {
                tables[i].classList.add('table-dark');
                tables[i].classList.remove('table-info');
            } else {
                tables[i].classList.remove('table-dark');
                tables[i].classList.add('table-info');
            }
        }

        var msAutoElements = document.querySelectorAll('.nav-link');
        for (var i = 0; i < msAutoElements.length; i++) {
            msAutoElements[i].classList.add('text-white');
        }

        // retain settings for chart if dark mode is enabled
        if (document.body.classList.contains('dark-mode')) {
            chart.updateOptions(darkOptions);
            chart1.updateOptions(darkOptions1);
        } else {
            chart.updateOptions(lightOptions);
            chart1.updateOptions(lightOptions1);
        }

    }
    </script>
    <script>
    //fetch data from api
    $.ajax({
        url: 'livepatrols.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // update the markers array
            let locations = response.locations;
            //find the median of the latitudes and longitudes
            let latitudes = [];
            let longitudes = [];
            for (var location in locations) {
                if (locations.hasOwnProperty(location)) {
                    latitudes.push(locations[location].lat);
                    longitudes.push(locations[location].long);
                }
            }
            let medianLatitude = latitudes.sort()[Math.floor(latitudes.length / 2)];
            let medianLongitude = longitudes.sort()[Math.floor(longitudes.length / 2)];
            let median = [medianLatitude, medianLongitude];



            // map initialization
            var map = L.map("map").setView(median, 30);

            // add tile layer
            L.tileLayer("https://mt0.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            // add markers from the locations object
            for (var location in locations) {
                if (locations.hasOwnProperty(location)) {
                    var lat = locations[location].lat;
                    var lng = locations[location].long;
                    var title = location;
                    var marker = L.marker([lat, lng], {
                        icon: L.icon({
                            iconUrl: "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png",
                            iconSize: [20, 35],
                            iconAnchor: [10, 35],
                            popupAnchor: [1, -34],
                            tooltipAnchor: [16, -28]
                        })
                    }).addTo(map);

                    marker.bindPopup(title);
                }
            }

            // add circle
            var circle = L.circle([-1.2418831, 36.793715], {
                color: 'green',
                fillOpacity: 0.5,
                radius: 100
            }).addTo(map);
        }
    });
    </script>

</body>

</html>