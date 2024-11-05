<script setup>
const props = defineProps(['menuItems']);
const emit = defineEmits(['menuClick']);


</script>

<template>
	<section id="main_menu">
		<ul>
			<li v-for="item in menuItems"
				:class="[(item=='separator')?'separator':'menu-item',
				(item?.active===true)?'active':null]">
				<a v-if="!(item == 'separator')" href="#"
				   @click.prevent="$emit('menuClick',item.id)">{{ item.text }}</a>
			</li>
		</ul>
	</section>
</template>

<style scoped>
#main_menu {
	a {
		text-decoration : none;
		color           : inherit;
	}
}
</style>
