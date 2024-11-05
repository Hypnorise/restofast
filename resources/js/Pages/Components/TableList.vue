<script setup>
const props = defineProps(['items']);

</script>

<template>
	<div v-for="item in items" :key="item.id" @click.prevent=""
		class="accordion">
		<div class="accordion-head">
			<h2>{{ items.name }}</h2>
		</div>
		<div class="accordion-content">
			<slot></slot>
		</div>
	</div>
</template>

<style scoped>
.accordion {
	.accordion-head {
		cursor : pointer;
	}
}
</style>
