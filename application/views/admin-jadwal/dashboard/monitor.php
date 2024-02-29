<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="card">
        <div class="card-body">
            <div id='calendar'></div>
            <!-- Cloudflare Pages Analytics -->
            <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Detail Operasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="eventModalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var calendarEl = document.getElementById('calendar');
        var scrollTime = moment().subtract(2, 'hours').format("HH:mm:ss");

        // Fungsi untuk memperbarui data event dan resource dengan AJAX
        function updateEventData() {
            // Mendapatkan data event
            $.ajax({
                type: 'POST',
                url: 'getEvent',
                dataType: 'json',
                success: function(response) {
                    if (response.length != 0) {
                        // Membersihkan event yang ada sebelum menambahkan yang baru
                        calendar.getEvents().forEach(function(event) {
                            event.remove();
                        });
                        // Menambahkan event baru ke kalender
                        response.forEach(function(event) {
                            calendar.addEvent({
                                resourceId: event.resourceId,
                                title: event.pasien,
                                start: event.start,
                                end: event.end,
                                dokter: event.dokter_opr,
                                detail: event.diagnosa_pasien,
                                tindakan: event.nama_tindakan_operasi,
                                tahapan: event.tahapan,
                                color: event.color
                            });
                        });
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' - ' + error);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'getResource',
                dataType: 'json',
                success: function(response) {
                    if (response.length != 0) {
                        // Membersihkan resource yang ada sebelum menambahkan yang baru
                        calendar.getResources().forEach(function(resource) {
                            resource.remove();
                        });
                        // Loop melalui respons dan tambahkan setiap resource ke kalender
                        response.forEach(function(resource) {
                            calendar.addResource({
                                "id": resource.id,
                                "title": resource.nama_ruangan
                            });
                        });
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' - ' + error);
                }
            });
        }
        setInterval(updateEventData, 1000);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'GMT',
            initialView: 'resourceTimelineDay',
            scrollTime: scrollTime,
            locale: 'id',
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false,
                hour12: false
            },
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                omitZeroMinute: false,
                meridiem: false,
                hour12: false
            },
            aspectRatio: 1.4,
            nowIndicator: true,
            headerToolbar: {
                left: 'prev,next',
                center: '',
                right: 'title'
            },
            editable: false,
            resourceAreaHeaderContent: 'Ruangan',
            resourceAreaWidth: '8%',
            views: {
                resourceTimelineDay: {
                    buttonText: 'day',
                    slotDuration: '00:10'
                },
            },
            eventClick: function(info) {
                // Get the event information
                var title = info.event.title;
                var detail = info.event.extendedProps.detail;
                var dokter = info.event.extendedProps.dokter;
                var tindakan = info.event.extendedProps.tindakan;
                var tahapan = info.event.extendedProps.tahapan;
                var start = new Date(info.event.start.getTime() - (7 * 60 * 60 * 1000));
                var end = new Date(info.event.end.getTime() - (7 * 60 * 60 * 1000));
                var startTime = ('0' + start.getHours()).slice(-2) + ':' + ('0' + start.getMinutes()).slice(-2);
                var endTime = ('0' + end.getHours()).slice(-2) + ':' + ('0' + end.getMinutes()).slice(-2);



                // Status operasi berdasarkan tahapan
                var operasiStatus = "";
                switch (tahapan) {
                    case "0":
                        operasiStatus = "Belum Dimulai";
                        break;
                    case "1":
                        operasiStatus = "Sign In";
                        break;
                    case "2":
                        operasiStatus = "Mulai Induksi";
                        break;
                    case "3":
                        operasiStatus = "Selesai Induksi";
                        break;
                    case "4":
                        operasiStatus = "Time Out";
                        break;
                    case "5":
                        operasiStatus = "Incisi";
                        break;
                    case "6":
                        operasiStatus = "Sign Out";
                        break;
                    case "7":
                        operasiStatus = "Closure";
                        break;
                    case "8":
                        operasiStatus = "Extubasi";
                        break;
                    default:
                        operasiStatus = "Transfer";
                        break;
                }

                // Display the information in the modal
                var modalBody = document.getElementById('eventModalBody');
                modalBody.innerHTML =
                    '<p><strong>Pasien:</strong> ' + title + '</p>' +
                    '<p><strong>Tindakan:</strong> ' + tindakan + '</p>' +
                    '<p><strong>Detail:</strong> ' + dokter + '</p>' +
                    '<p><strong>Dokter:</strong> ' + detail + '</p>' +
                    '<p><strong>Start Time:</strong> ' + startTime + '</p>' +
                    '<p><strong>End Time:</strong> ' + endTime + '</p>' +
                    '<p><strong>Operasi:</strong> ' + operasiStatus + '</p>';

                // Show the modal
                $('#eventModal').modal('show');

                // Close the modal when the close button is clicked
                $('#eventModal .close').on('click', function() {
                    $('#eventModal').modal('hide');
                });

                // Close the modal when the "Tutup" button is clicked
                $('#eventModal .btn-secondary').on('click', function() {
                    $('#eventModal').modal('hide');
                });

                // Close the modal when the backdrop is clicked
                $('#eventModal').on('click', function(e) {
                    if (e.target === this) {
                        $('#eventModal').modal('hide');
                    }
                });
            },

        });

        calendar.render();
    });
</script>