<div 
x-data="{
    form : document.querySelector('.otp-form'),
    inputs : null,
    getValues() {
        let values = '';
        this.inputs.forEach((input, i) => {
            values += input.value;
        })
        return values;
    },
    handleInput(e) {
        const input = e.target;
        let getValues = this.getValues();

        this.$wire.set('otp', getValues, true);
        const nextInput = input.nextElementSibling
        if (nextInput && input.value) {
            nextInput.focus()
            if (nextInput.value) {
                nextInput.select()
            }
        }
    },
    handlePaste(e) {
        e.preventDefault();
        const paste = e.clipboardData.getData('text');
        this.inputs.forEach((input, i) => {
            input.value = paste[i] || '';
            let getValues = this.getValues();
            this.$wire.set('otp', getValues, true);
        })
    },

    handleBackspace(e) { 
        const input = e.target
        if (input.value) {
            input.value = '';
            let getValues = this.getValues();
            this.$wire.set('otp', getValues, true);
            return
        }
        input.previousElementSibling.focus()
    },

    handleArrowLeft(e) {
        const previousInput = e.target.previousElementSibling
        if (!previousInput) return
        previousInput.focus()
    },

    handleArrowRight(e) {
        const nextInput = e.target.nextElementSibling
        if (!nextInput) return
        nextInput.focus()
    },

    init() {
        this.inputs = this.form.querySelectorAll('input');

        const KEYBOARDS = {
            backspace: 8,
            arrowLeft: 37,
            arrowRight: 39,
        }

        this.form.addEventListener('input', this.handleInput.bind(this));

        this.inputs[0].addEventListener('paste', this.handlePaste.bind(this));

        this.inputs.forEach(input => {
            input.addEventListener('focus', e => {
                setTimeout(() => {
                    e.target.select()
                }, 0);
            });

            input.addEventListener('keydown', e => {
                switch(e.keyCode) {
                    case KEYBOARDS.backspace:
                        this.handleBackspace(e)
                        break
                    case KEYBOARDS.arrowLeft:
                        this.handleArrowLeft(e)
                        break
                    case KEYBOARDS.arrowRight:
                        this.handleArrowRight(e)
                        break
                    default:  
                }
            });
        });
    }
}">
    <div class="flex flex-col w-full md:self-stretch">
        <div class="flex flex-col md:self-stretch px-7 md:px-0">
            <h1 class="text-slate-800 leading-9 font-bold md:text-[28px] text-xl">
                OTP Verification here
            </h1>
            <h2 class="text-sm font-light leading-6 md:text-base text-slate-600">
                Please enter the OTP code sent to the provided email address to continue.
            </h2>
        </div>
        @if ($verifiedNewUser)
        <style>
            .container{
                width: 90%;
                max-width: 500px;
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                position: relative;
            }
            .container:before{
                content: '';
                position: absolute;
                width: 400px;
                height: 450px;
                border-radius: 50% 40% 50% 50%;
                background-color: #e3c0ff;
                top: -6rem;
                left: -4.5rem;
                opacity: .3;
                box-shadow: 0 0 10px #e3c0ff;
            }
            .container:after{
                content: '';
                position: absolute;
                width: 600px;
                height: 350px;
                border-radius: 50% 33% 50% 50%;
                background-color: #f3e6fc;
                top: -5rem;
                right: -4rem;
                z-index: -1;
                opacity: .5;
                box-shadow: 0 0 10px #e6d3f6;
            }
            .container > .box1, .container >.box2{
                padding: 1rem 1rem 2rem;
                position: relative;
                border-radius: 10px;
                background-color:#ffffff ;
                box-shadow: 0 0 10px #f8f4ff, 0 0 10px #b5a6c1;
                overflow: hidden;
            }
            .container .xmark-box{
                position: absolute;
                top: 1rem;
                right: 1rem;
                background-color: #f9f9fb;
                color: #555662;
                width: 20px;
                height: 20px;
                border-radius: 0;
                border-radius: 50%;
                box-shadow: 0 0 0 2.5px #f9f9fb;
                text-align: center;
                transition: all .2s;
                cursor: pointer;
            }
            .container .xmark-box:hover{
                opacity: .8;
            }
            .container > .box1 > .caption-box, .container > .box2 > .caption-box{
                display: flex;
                gap: 1rem;
                align-items: center;
                position: relative;
            }
            .container > .box1:after{
                content: '';
                position: absolute;
                width: 300px;
                height: 100px;
                background-color: #d6ebf4;
                opacity: .4;
                border-radius: 50%;
                top: 1.5rem;
                left: -9rem;
                rotate: 92deg;
            }
            .container > .box2:after{
                content: '';
                position: absolute;
                width: 300px;
                height: 100px;
                background-color: #facaf3;
                opacity: .4;
                border-radius: 50%;
                top: 1.5rem;
                left: -9rem;
                rotate: 92deg;
            }
            .container img{
                width: 30px;
                height: 30px;
            }
            .container .caption-box{
                margin-top: .8rem;
            }
            .container .caption{
                margin-left: .7rem;
            }
            .container .caption h5 {
                margin: 1rem 0 .5rem;
                font-size: 15px;
            }
            .container .caption p{
                font-size: 14px;
            }
        </style>
        <div class="container w-full flex justify-center items-center">
            <div class="box1">
                <div class="xmark-box">
                    <i class="fa-solid fa-x"></i> <!--xmark-->
                </div>
                <div class="caption-box">
                    <img src="https://www.pngall.com/wp-content/uploads/2/Approved-PNG-Download-Image.png" alt="approveimg">
                    <div class="caption">
                        <h5>Thank you for verifying!</h5>
                        <p>Please continue to finish setting up your account.</p>
                        <a href="" class="text-blue-600 font-normal md:text-base text-sm">Continue</a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <form wire:submit="verify" x-ref="otpForm" class="otp-form flex md:w-[400px] w-full pt-[24px] pb-2 px- flex-col items-start gap-6 text-slate-500 px-7 md:px-0">
                <div class="flex flex-wrap items-start w-full gap-3 md:self-stretch md:gap-6">
                    @for($i = 0; $i < 6; $i++)
                        <input class="otp-input flex flex-col justify-center items-center gap-2 w-1/4 rounded-xl focus:ring-0 text-center font-semibold text-base h-[50px]" type="tel" style="flex: 1 0 0;" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" maxlength="1" pattern="[0-9]">
                    @endfor
                </div>
                @if($otpErrMsg) 
                    <div class="text-sm text-red-600">
                        <span class="error">{{ $otpErrMsg }}</span> 
                    </div>
                @endif
                <div class="flex items-start self-stretch w-full gap-4">
                    <button class="flex w-full py-1 justify-center items-center bg-blue-600 hover:bg-blue-800 rounded-3xl text-white semifont-bold text-sm" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-blue-600" wire:loading.attr="disabled">
                        <span class="" wire:loading.remove wire:target='verify'>Verify</span>
                        <div wire:loading wire:target='verify'>
                            <i class="uil uil-spinner w-[44px] h-[40px] py-[12px] justify-center items-center flex text-2xl text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
                <div class="flex flex-col justify-center w-full text-center" id="" role="presentation">
                    <div class="font-medium text-slate-800">
                        Don’t have an account?
                        <a href="#" class="font-semibold text-blue-600">Sign up</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
       @this.on('user-logged-in', (event) => {
            localStorage.setItem("nexus-19291-token", event);
       });
    });

</script>