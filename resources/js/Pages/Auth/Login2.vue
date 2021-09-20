<template>
    <Head title="Log in" />

    <BreezeValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Forgot your password?
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },
    setup(){
        const form = Inertia.form(
            {
                email:'',
                password:'',
                remember: false
            }
        )
        const submit = ()=>{
            form.post(route('login'),{
                onFinish:()=>form.reset('password')
            })
        }
        return {form,submit}
    },
    

    
}
</script>
<style scoped>
.back {
  position: absolute;
  background-size: cover;
  background-position: center;
  background-image: url("https://images.theconversation.com/files/303322/original/file-20191124-74557-16zkcnl.jpg?ixlib=rb-1.1.0&rect=60%2C874%2C5643%2C2821&q=45&auto=format&w=2560&h=1440&fit=crop");
  height: 100vh;
  width: 100%;
  background-repeat: no-repeat;
}
.dark {
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  background-size: cover;
  background-color: rgba(73, 66, 52, 0.657);
  /* z-index: 1; */
  width: 100%;
  height: 100vh;
}

</style>