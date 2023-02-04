<template>
    <AppLayout>
        <template #header>
                <PrimaryButton style="float: right" @click="createTask">
                    Create Task
                </PrimaryButton>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Task Management
                </h2>  
        </template>
        <div class="flex px-4 mx-10">
            <table class="a-auto w-full border-collapse-border border-slate-400">
                <thead>
                    <tr class="bg-indigo-900 text-white">
                        <th>ID</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Assignee</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center odd:bg-white even:bg-slate-200 hover:bg-blue-500" v-for="(task,index) in collection.tasks" :key="index">
                        <td> {{ task.id }} </td>
                        <td> {{ task.description }} </td>
                        <td> {{ task.status_string }} </td>
                        <td> {{ task.assignee }} </td>
                        <td>
                            <div class="flex gap-2 justify-center">
                                <SecondaryButton @click="editTask(task.id)">
                                    Edit
                                </SecondaryButton>
                                <DangerButton @click="showDeleteDialog">
                                    Delete
                                </DangerButton>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>  
        </div>   
        <!-- Delete congiormation Dialog -->
        <DialogModal :show="show_delete_dialog" @close="show_delete_dialog=false">
            <template #title>
                <h1>Delete Task</h1>
            </template>
            <template #content>
                <p1>Are you sure you want to delete the task?</p1>
            </template>
        </DialogModal>
    </AppLayout>
</template>
<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { router } from '@inertiajs/vue3';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import DialogModal from '@/Components/DialogModal.vue';

    export default {
        props: {
            collection: Object
        },
        components: {
            AppLayout,
            PrimaryButton,
            SecondaryButton,
            DangerButton,
            DialogModal
        },

        data: function(){
            return{
                show_delete_dialog:false
            }
        },
        methods: {
            createTask() {
                this.$inertia.visit(route('tasks.create'),{ method : 'get' });
            },
            editTask(id) {
                this.$inertia.visit(route('tasks.edit', id),{ method : 'get' });
            },
            showDeleteDialog() {
                this.show_delete_dialog = true;
            }
        }
    }
</script>