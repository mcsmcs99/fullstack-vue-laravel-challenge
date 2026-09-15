<script setup>
import { onMounted, ref, watch } from 'vue'
import api from '../api/api'
import PurchasesTable from '../components/PurchasesTable.vue'

const filters = [
  { label: 'Todos', value: '' },
  { label: 'Pendentes', value: 'pending' },
  { label: 'Pagos', value: 'paid' },
  { label: 'Cancelados', value: 'cancelled' },
]

const purchases = ref([])
const status = ref('')
const loading = ref(false)
const error = ref(null)

async function fetchPurchases() {
  loading.value = true
  error.value = null

  try {
    const response = await api.get('/purchases', {
      params: status.value ? { status: status.value } : {},
    })
    purchases.value = response.data.data
    loading.value = false
  } catch (err) {
    error.value = 'Não foi possível carregar as compras.'
  }
}

watch(status, fetchPurchases)
onMounted(fetchPurchases)
</script>

<template>
  <section>
    <h1>Compras de cursos</h1>

    <div class="filters">
      <button
        v-for="filter in filters"
        :key="filter.value"
        type="button"
        :class="{ active: status === filter.value }"
        @click="status = filter.value"
      >
        {{ filter.label }}
      </button>
    </div>

    <p v-if="loading">Carregando...</p>
    <p v-else-if="error" class="error">{{ error }}</p>
    <PurchasesTable v-else :purchases="purchases" />
  </section>
</template>

<style scoped>
.filters {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.filters button {
  padding: 0.4rem 0.9rem;
  min-width: 6.5rem;
  border: 1px solid #b5b5b5;
  border-radius: 4px;
  background-color: #fff;
  color: #222;
  font: inherit;
  cursor: pointer;
}

.filters button:hover {
  border-color: #888;
}

.filters button.active {
  background-color: #333;
  color: #fff;
  border-color: #333;
  font-weight: 600;
}

.error {
  color: #8c1c24;
}
</style>
