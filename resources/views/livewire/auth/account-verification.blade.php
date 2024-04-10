<div class="flex flex-col items-center justify-center w-full h-full min-h-full">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center md:p-[32px] pb-3 rounded-2xl md:border-slate-300 md:border">
        <livewire:auth.otp :email="$payload['email']" :from="$payload['from']" :verificationMethod="'verifyRegistration'">
    </div>
</div>