<template>
    <div>
        <trix-editor @change="updateContent" v-model="content"></trix-editor>
    </div>
</template>

<script>
import "trix";
export default {
    props: {
        value: String,
    },
    data() {
        return {
            content: this.value || '',
        };
    },
    methods: {
        updateContent(event) {
            this.$emit('input', event.target.innerHTML);
        },
    },
};
</script>

<style>
@import 'trix/dist/trix.css';
</style>
