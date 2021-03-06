<footer class="footer">

</footer>
<script type="text/javascript" src="{{ url('assets/js/jquery-2.1.3.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.dataTables.js') }}"></script>
{{-- <script type="text/javascript" src="{{ url('assets/js/main.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        filter();
    });

    function filter() {
        start=$("#start_filter").val();
        end=$("#end_filter").val();
        console.log(start,end)
        $('#geniustable').DataTable().destroy();
       
        var table = $('#geniustable').DataTable({

            "lengthMenu": [5, 10, 25, 50, 100, 250, 500, 1000],
            pageLength: 50,
            ordering: true,
            processing: true,
            serverSide: true,
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            "ajax": {

                "url": `/json-home?un=123&up=321&test={{ $test ?? 0 }}&from=${start}&to=${end}`,

            },
            columns: [{
                    data: 'user_id',
                    name: 'user_id',
                    "defaultContent": ""
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                    "defaultContent": ""
                },
                {
                    data: 'message',
                    name: 'message',
                    "defaultContent": ""
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    "defaultContent": ""
                },
            ],


        });
    }
</script>
</body>

</html>
