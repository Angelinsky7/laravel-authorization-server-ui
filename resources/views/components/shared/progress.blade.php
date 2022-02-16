<!-- x-policy-ui-shared:progress -->
<div x-data="{
    percent: 0,
    init(){
        const progressInterval = setInterval(() => {
            this.percent++;
            if(this.percent >= 100){
                clearInterval(progressInterval);
            }
        }, 50);
    }
}" {{ $attributes->class(['h-2 relative overflow-hidden'])->merge([]) }}>
    <div class="w-full h-full bg-gray-200 absolute"></div>
    <div class="h-full bg-green-500 absolute transition-width"
         :style="`width: ${percent}%`">
    </div>
</div>
