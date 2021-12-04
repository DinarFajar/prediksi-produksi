@props(['type'])

@if($type === 'styles')
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@elseif($type === 'scripts')
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script type="text/javascript">
    $(function() {
      $('#dataTable').DataTable({
        language: {
          url: "{{ asset('vendor/datatables/dataTables.indonesian.json') }}"
        }
      });
    });
  </script>
@endif