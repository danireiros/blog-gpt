<template>
    <AppLayout>
        <AuthorLayout>
            <p class="m-2">Layout de autor (STEP.vue)</p>
            <p class="m-2">Paso {{ $page.props.step }}</p>
            <FormAuthor             :errors="errors" :authorGeneral="authorGeneral" :enumType="enumType"/>
            <FormAuthorCompany      :errors="errors" :authorCompany="authorGeneral.company" :enumChoices="enumChoices" :authors="authors"/>
            <FormAuthorPerson       :errors="errors" :authorPerson="authorGeneral.person" :enumChoices="enumChoices" :authors="authors"/>
            <FormAuthorDetail       :errors="errors" :authorDetail="authorGeneral.detail" :authors="authors"/>
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