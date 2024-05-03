<script setup>
import { computed, useSlots } from 'vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <div>
        <h2 class="mb-4 mt-4 text-2xl font-bold tracking-tight text-gray-700 dark:text-white">
            <slot name="title" />
        </h2>

        <div class="md:mt-0 w-100">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class=""
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                >
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions" class="flex items-center justify-end text-end sm:rounded-bl-md sm:rounded-br-md">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
