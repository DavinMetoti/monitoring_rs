<div class="container-fluid">
    <div class="mt-3 d-flex justify-content-between ">
        <div style="font-weight: bold;">
            MONITORING OPERASI
        </div>
        <div class="d-flex justify-content-center gap-2">
            <span style="font-size: 16px;" class="badge badge-danger">Pra Operasi</span>
            <span style="font-size: 16px;" class="badge badge-warning">Operasi</span>
            <span style="font-size: 16px;" class="badge badge-success">Pasca Operasi</span>
        </div>
    </div>
    <div id='calendar'></div>
    <!-- Cloudflare Pages Analytics -->
    <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Detail Event</h5>
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
                url: './operasi/getEvent',
                dataType: 'json',
                success: function(response) {
                    if (response.length != 0) {
                        calendar.getEvents().forEach(function(event) {
                            event.remove();
                        });
                        // Menambahkan event baru ke kalender
                        response.forEach(function(event) {
                            var title = ""; // Inisialisasi judul

                            // Mengambil inisial dari nama pasien
                            var pasienName = event.pasien;
                            var initials = pasienName.split(' ').map(function(name) {
                                return name.charAt(0);
                            }).join('');

                            // Mengatur judul event dengan inisial pasien
                            title = "#" + initials;

                            calendar.addEvent({
                                resourceId: event.resourceId,
                                title: title + "-" + event.nama_tindakan_operasi, // Gunakan judul yang sudah ditentukan
                                start: event.start,
                                end: event.end,
                                detail: event.diagnosa_pasien,
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
                url: './operasi/getResource',
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
                left: '',
                center: '',
                right: ''
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
        });

        calendar.render();
    });
</script>