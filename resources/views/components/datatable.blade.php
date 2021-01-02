<table id="{{ $name }}" class="table dataTable"></table>

<script>
  App.addDataTable('{{ $name }}', '{!!  @addslashes($dataTable->getJSON()) !!}');
</script>