<script setup>
const props = defineProps(['tableList']);
const emit = defineEmits(['addOrder'])

function toggleAccordion(e) {
	/**  @type HTMLElement */
	let accordion = e.currentTarget.closest(".accordion");
	accordion.classList.toggle("open");
}
</script>

<template>
	<div v-for="table in tableList" :key="table.id"
		 class="accordion">
		<div class="accordion-head">
			<h2>{{ table.name }}</h2>
			<span v-if="table.orders.length>0"
				class="amount">
				{{ Intl.NumberFormat('fr').format(table.orders[0]?.amount) }} Ar
			</span>
			<button v-if="table.orders.length>0"
					@click.prevent="toggleAccordion($event)">Show Details</button>
			<button v-else @click.prevent="emit('addOrder')">New Order</button>
		</div>
		<div class="accordion-content">
			<ul>
				<li v-for="product in table.orders[0]?.products">{{ product.name }} x {{ product.pivot.quantity }}</li>
			</ul>
			<div class="comment">{{table.orders[0]?.comment}}</div>
		</div>
	</div>
</template>

<style scoped>
.accordion {
	&::after {
		content: "<";
	}
	.accordion-content {
		display : none;
	}
}
.accordion.open {
	.accordion-content {
		display : block;
	}
}
.accordion.open::after {
	content: ">";
}
</style>
