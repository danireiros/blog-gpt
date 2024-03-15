<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">SoyMotor</h2>
                    
                        <div v-if="links">
                            <!-- <div v-html="content"></div> -->
                            <div class="border-b" v-for="l in links" :key="l.id">
                                {{ l }}
                            </div>
                        </div>
                        <div v-else>
                            No hay nah pa ti miniño
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    props: {
        links: Array,
    },
    setup() {
        
    },
}
</script>