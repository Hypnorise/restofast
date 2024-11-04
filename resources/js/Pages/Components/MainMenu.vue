<script setup>
const props = defineProps(['menuItems']);
const emit = defineEmits(['menuClick']);

</script>

<template>
    <section id="main_menu">
        <ul>
            <li :class="[(item=='separator')?'separator':'menu-item']"
                v-for="item in menuItems">
                <a v-if="!(item == 'separator')" @click.prevent="$emit('menuClick',item.id)"
                   href="#">{{item.text}}</a>
            </li>
        </ul>
    </section>
</template>

<style scoped>
#main_menu {
	a {
		text-decoration : none;
		color : inherit;
	}
}
</style>
