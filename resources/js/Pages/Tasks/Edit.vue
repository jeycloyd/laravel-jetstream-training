<template>
<AppLayout title="Create Task">
    <div class="flex px-4 m-10">
    <FormSection @submitted.preventDefault="">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description" value="Description" />
                <TextInput
                    id="name"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="description"
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="status" value="Status" />
                <TextInput
                    id="name"
                    v-model="form.status"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="status"
                />
                <InputError :message="form.errors.status" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="assignee" value="Assignee" />
                <TextInput
                    id="name"
                    v-model="form.assignee"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="assignee"
                />
                <InputError :message="form.errors.assignee" class="mt-2" />
            </div>
            

            
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton @click="saveTask" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
   </div> 
    </AppLayout>
</template>
<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { Link } from '@inertiajs/vue3';
    import ActionMessage from '@/Components/ActionMessage.vue';
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    export default {
        props: {
            task: Object
        },
        components: {
            AppLayout,
            PrimaryButton,
            ActionMessage,
            FormSection,
            InputError,
            InputLabel,
            SecondaryButton,
            TextInput,
            Link
        },

        data: function() {
            return {
                form: this.$inertia.form({
                    description: this.task.description,
                    status: this.task.status_string,
                    assignee: this.task.assignee
                }),
            };
        },
        
        methods: {
            saveTask(){
                this.$inertia.put(route('tasks.update', this.task.id), this.form, {
                    onSuccess: () => this.form.reset()
                });   
            }
        }
    }
</script>