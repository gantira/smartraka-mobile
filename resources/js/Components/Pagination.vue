<template>
    <nav
        aria-label="Page navigation example"
        v-if="showPagination"
    >
        <ul class="pagination">
            <li
                class="page-item"
                v-for="(link, key) in links"
                :key="key"
                v-bind:class="isActive(link)"
            >
                <inertia-link
                    class="page-link"
                    :href="link.url"
                    v-if="link.url"
                    preserveState
                    preserveScroll
                ><span v-html="link.label"></span></inertia-link>
                <a
                    class="page-link"
                    href="#"
                    v-else
                    @click.prevent="handleNoLink"
                ><span v-html="link.label"></span></a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        links: Array,
    },
    computed: {
        showPagination() {
            return this.links.length > 3;
        },
    },
    remember: ["links"],
    methods: {
        isActive(link) {
            return link.active === true ? "active" : "normal";
        },
        handleNoLink() {
            return false;
        },
    },
};
</script>
