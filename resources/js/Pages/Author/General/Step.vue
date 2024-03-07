<template>
    <AppLayout>
        <AuthorLayout>

            {{ $page.props.step }}

            <div class="flex">
                <div class="flex mx-auto flex-col sm:flex-row mt-2">
                    <div class="form-step bg-white" :class="{active: $page.props.step == 1}">
                        PASO 1
                    </div>
                    <div class="form-step bg-white" :class="{active: parseInt($page.props.step) == 2}">
                        PASO 2
                    </div>
                    <div class="form-step bg-white" :class="{active: $page.props.step == 3}">
                        PASO 3
                    </div>
                    <div class="form-step bg-white" :class="{active: $page.props.step == 4}">
                        FIN
                    </div>
                </div>
            </div>

            <!-- <p class="m-2">Paso {{ $page.props.step }}</p> -->
            <FormAuthor 
                v-if="$page.props.step == 1" 
                :errors="errors" 
                :authorGeneral="authorGeneral" 
                :enumType="enumType"/>
            <FormAuthorCompany 
                @back-step-event="backStep"
                v-if="$page.props.step == 2.5" 
                :errors="errors" 
                :authorCompany="authorGeneral.company" 
                :enumChoices="enumChoices" 
                :authors="authors" 
                :generalId="authorGeneral.id"/>
            <FormAuthorPerson 
                @back-step-event="backStep"
                v-if="$page.props.step == 2" 
                :errors="errors" 
                :authorPerson="authorGeneral.person" 
                :enumChoices="enumChoices" 
                :authors="authors" 
                :generalId="authorGeneral.id"/>
            <FormAuthorDetail 
                v-if="$page.props.step == 3" 
                :errors="errors" 
                :backStep="authorGeneral.type == 'person' ? 2 : 2.5"
                :authorDetail="authorGeneral.detail" 
                :authors="authors" 
                :generalId="authorGeneral.id"
                @back-step-event="backStep"/>
            <div v-if="$page.props.step == 4" class="p-3 m-3 bg-orange-100">
                Autor finalizado
            </div>
        </AuthorLayout>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AuthorLayout from "@/Layouts/AuthorLayout.vue";
import FormAuthor from "@/Pages/Author/General/Form.vue";
import FormAuthorCompany from "@/Pages/Author/Company/Form.vue";
import FormAuthorPerson from "@/Pages/Author/Person/Form.vue";
import FormAuthorDetail from "@/Pages/Author/Detail/Form.vue";

export default {
    methods: {
        backStep(value){
            this.$page.props.step = value;
        }
    },      
    components: {
        AuthorLayout,  
        AppLayout,
        FormAuthor, 
        FormAuthorCompany,
        FormAuthorPerson,
        FormAuthorDetail,
    },
    props: {
        errors: Object,
        authorGeneral: Object,
        authorCompany: Object,
        authorPerson: Object,
        authorDetail: Object,
        enumType: Array,
        enumChoices: Array,
        authors: Object,
    }
}
</script>