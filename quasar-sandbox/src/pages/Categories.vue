<template>
  <div class="q-pa-md">
    <q-table
      title="Treats"
      :rows="rows"
      :columns="columns"
      row-key="id"
      v-model:pagination="pagination"
      :loading="loading"
      :filter="filter"
      @request="fetchCategories"
      binary-state-sort
    />
  </div>
</template>

<script>
import { api } from 'boot/axios'
import { onMounted, ref } from 'vue'
const columns = [
  {
    name: 'id',
    label: 'ID',
    field: 'id'
  },
  {
    name: 'name',
    label: 'Nome',
    field: 'name'
  },
  {
    name: 'description',
    label: 'Descrição',
    field: 'description'
  }
]
export default {
  setup () {
    const rows = ref([])
    const filter = ref('')
    const loading = ref(false)
    const pagination = ref({
      sortBy: 'desc',
      descending: false,
      page: 1,
      rowsPerPage: 1,
      rowsNumber: 10
    })

    function fetchCategories (props) {
      const { page } = props.pagination

      loading.value = true

      api.get('/categories', { params: { page } }).then(response => {
        rows.value = response.data.data
        pagination.value.rowsNumber = response.data.total
        pagination.value.page = response.data.current_page
        pagination.value.rowsPerPage = response.data.per_page
        loading.value = false
      })
    }

    onMounted(() => {
      fetchCategories({
        pagination: pagination.value,
        filter: undefined
      })
    })

    return {
      filter,
      loading,
      pagination,
      columns,
      rows,
      fetchCategories
    }
  }
}
</script>

<style>

</style>
