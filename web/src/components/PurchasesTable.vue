<script setup>
defineProps({
  purchases: {
    type: Array,
    required: true,
  },
})

const statusLabels = {
  pending: 'Pendente',
  paid: 'Pago',
  canceled: 'Cancelado',
}

function statusLabel(status) {
  return statusLabels[status] ?? status
}

function formatCurrency(value) {
  return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value)
}

function formatDate(value) {
  return new Date(value).toLocaleDateString('pt-BR')
}
</script>

<template>
  <table class="purchases-table">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>Curso</th>
        <th>Data da compra</th>
        <th>Status</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="purchase in purchases" :key="purchase.id">
        <td>{{ purchase.customer.name }}</td>
        <td>{{ purchase.course.title }}</td>
        <td>{{ formatDate(purchase.purchased_at) }}</td>
        <td>
          <span class="status" :class="`status--${purchase.status}`">
            {{ statusLabel(purchase.status) }}
          </span>
        </td>
        <td>{{ formatCurrency(purchase.amount) }}</td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
.purchases-table {
  width: 100%;
  border-collapse: collapse;
}

.purchases-table th,
.purchases-table td {
  text-align: left;
  padding: 0.6rem 0.75rem;
  border-bottom: 1px solid #e2e2e2;
}

.purchases-table th {
  background-color: #f5f5f5;
  color: #333;
  font-weight: 600;
}

.status {
  display: inline-block;
  padding: 0.2rem 0.6rem;
  border-radius: 4px;
  font-size: 0.85rem;
  font-weight: 500;
}

.status--pending {
  background-color: #fff3cd;
  color: #7a5b00;
}

.status--paid {
  background-color: #d4edda;
  color: #1e6b30;
}

.status--canceled {
  background-color: #f8d7da;
  color: #8c1c24;
}
</style>
