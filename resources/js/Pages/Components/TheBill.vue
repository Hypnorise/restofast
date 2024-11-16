<script setup>
const props = defineProps(["billDetails"])

</script>

<template>
<section id="bill">
	<header>
		<h2>{{billDetails.table.name}}</h2>
		<span>Order ref : {{billDetails.table.orders[0]?.ref||"( New )"}}</span>
	</header>
</section>
</template>

<style scoped>
section {
	header {
		display : flex;
		justify-content: space-between;
		align-items: baseline;
		h2 {
			margin : 0;
		}
	}
}
</style>
