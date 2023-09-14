<div>
  <button
    wire:click="loginSignup"
    class="pr-2 pt-1 pb-1">
    Login/Register
  </button>
  <x-jet-dialog-modal wire:model="signupDialog">
    <x-slot name="title">
      <div class="text-xl font-bold mb-4 text-black">
        @if ($mailSent)
          <button wire:click="goBack" class="font-bold text-colorx">
            <div class="flex flex-row">
              <div class="text-sm items-center m-auto">
                &#10094;
              </div>
              <div>
                &nbsp;Back
              </div>
            </div>
          </button>
        @else
          Login/Sign Up
        @endif
      </div>
    </x-slot>
    <x-slot name="content">
      <div class="border border-dashed p-10">
        <div class="{{ $mailSent ? 'hidden' : '' }}">
          <div class="relative">
            @if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailPhone))
              <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                  <img class="w-6 h-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAEd0lEQVR4nO3aW6gVVRzH8Y8XDNNumgqllBBWh0Aq7UImUQ8ZKlF006KoQCyIIgKhC/XQgw8RSL30UhF0sSKiGxVUBqWRZA+lhVCiJ7uYYZ6O2SnP2T2sPczax9nH2fvMnrY2Xxj2Zf5rzW/9Zmat/6w1VFRUVFRUVFRU/D8Z0+T/o3ElLsSMEeK6nRp+wXq8gT/zFFqCnfXCR9K2E4uHN3b4mb0GL2Fc/fde/JbHtS5mKo6rfx/EdXgtK3A6+gS3+nEHxpcgsNOMF9rSL7Ttd0zLCnxIerlcX5a6ErlB2r4HsgLW1XduKlFU2XwptPGj5I+x0c6T6p9bylRUMpvrnydn7fxecOcHnFeWohI5B71CG7dlBSQG1PAPVpUmrfPchH3S9h3SgGR7HpPL0dgRjsIaB7drRAM+x44oeDPOKEFs0czEZ9J2/Iwv5DDgWZyId6PCfwjDyOHCQvwk1b8Rp+AZOQ0gZImrhOwpqegpTOig8CJYgb9la27JgIRLhcsndvPUolUXwGSslercj9uHxbRlAOF+Wh9V/isuL0J1QczBV1J92zE/I65tAwg59eroIEP132ObxJfFUuyR6noHU5rEjsqAhOVCp5gc8ANhzqBsxuERaR+V54QUYgCcrvGS68UFOYUXwVS8Fx1/L67KUa4wAwidzouRiLKyx7M1Jm3f4MycZQs1IGEFBiJBncwebxamtZJjvYBJLZTviAEwr15pIuxbnNVGPc0YntK2e7V1zAA6lz3OxIao3l1CbtIOBxlQ5BC2W5hwSEj6iDXazx4vEyZo4g52QHhkL5zRXAFj8aTGGdjd0e8NmNVCfUkafiCq45Po+4/oaUNnR26BcXg6ErcNp2k/ezwGr0Tl9uPW+r5VGm+FuS1qLdyACXg1ErVFaHhCq9njHHwdxW8XOtiY+6L9e3B+C3oLNWAS3o/EbBQ6wiyWS6elk9grhH5iDGYLxsSzNm/hhCb13S2YmZiQNwkrzIDj8Wkk9mMce4gyPULSEs/MDGkc12tCavuwQ3fQK6VpcB8uzqG7EAOmS6eXa3gbE3McnLDm+JjGMx1vm7AgZ12EviHpKPuFUWMkRm3ALCHJSQSv1d4QNwXL8CgeF+7rdmeilwuJUU24mhaNEDsqA2bjO2njn9M9S2dL8Zega0DzB6O2DejRuGL8hO5bMl8sDJlJqnxjRkxbBszXmNSsLkZvR1gk7VQP4JZh+1s24BLpivEQ7i1Wb0dYKNU8iNuifS0ZsER6SR1w8ARjN7NAmCRJTtxd9f9zG7BMOrU8gGs7q7cjzBNe7khMuEdOA3qlCcY+Iw8r3c65UhNq0un9TAO2RoE14U2KPNlVtzNXeHCK27Y1K3BdFLBLcO9IoUfjUtmHWUEPRgF3liatPFZK23d/VsA0ac/ZJ/T63b4OmIcJQluStYw9oqfW4dnc1XhZ+ppcv3A7HM7MkM4cDwqvAr4+UoFF0ldJjqRth4wZqWb5/EThAeOiuoP/9fpfuwwJQ996vCkkdhUVFRUVFRUVFRX4F62wTU4fLviuAAAAAElFTkSuQmCC"/>
                </button>
              </span>    
            @elseif(preg_match("/^\d+$/", $emailPhone))
              <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                  <img class="w-6 h-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAABRklEQVRoge3Wr27CUBTH8e9pBobd8gaEVE6SLZlBTewt0JMgmuIIEhDYTfMm28TEMjtBUh5hoSmmpDCxULOapbe7ITkf1Vxxz/nl/isopZRSZ0xOH8dHji4b+St5+Ondc91IVRrANQ3gmgZwTQO4VrzEu93urF7iVqslABd1TJ4kGcvlB2maAWBMk+Gwh+83rdeyHiBJMsbjV8LwmjzPERE8zyOKXpjN+tZDWN9C0+kbg8EVm82WON4CEARtul2f1eqTyeTWRpn6tlCa7snzA3G8Zb3+KsY7nUvSdG+7XF23UNliSslYddZXwJgGIh5B0C7GgqCNiGBMw3Y5+2cgSTKi6JkwvOFwOCICIsJi8c583scYO4f4dAZqeQfKrtHRqGeteag5wH/4dQvdPd2766aCs/8X0gCuaQDXNIBrGkAppZRSFXwD27peeb0XT8IAAAAASUVORK5CYII="/>
                </button>
              </span>
            @else
              <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                  <img class="w-6 h-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAADVklEQVRoge2ZTUgVURTHfz7Nj0I0JcSigr7ITAzMMqJaVUK7FgVFLapVRYWbaFe0DloVEZSbICLTdpUFpRhuhApDigrCrBDzI7LS1GlxzjRm+Zy59466eD94HN579/zv/8zMnTtzL6RIEQtpMWqvADYCq4B8YBToAVqBJmAkxr6tSQcOAe2Al+TzBtjqsmOXZ6QYqAM26fePQAvQBXTqb0uBauQs/QCuAzeApw59WJEPvEKO9mtgF5MfpARwgb/P0E1gbvw2p6YWMdQG5IVonwDWAKeAbs29E5u7kCxBBu4voNwgfxnQixRT7dBXZI6qiToLjbMEl9iMUa8mDltolKjGWyeODGlVE1UWGunAT2AMw0GfsOjcp1Bjv4XGKDCE3OkyTQRcFOLP0J6lTobGMZNkF4V0ayyy0ChALqlB4KuJgItCPmlcaKGxUuM7UwEXhbzQaDKH+GzR2GIq4KKQNo0bLDS2aWw2FXBRiK9RSTBgo5BJcEYGHPgx5jFyxzqN2dN0GnBGNR469BWZDjVhM0bKVeOlqYCLS6tdY4WFRqVG40JccBA5mu+BGoP8Gs31gAMOfUUmHbiNzMgDRDvLCc3xn57Tnbsz4BliqDRCTpnmdNh27mKM+DzRuD9Czr4JubOCCuTo9gILQrQvAL5ozuYYfRnRgBh7TPB4/z9ygfvatnEafEVmEfCZqV+0VmubfmC5i45djhGQNayuCP324Oj11nUhEO4Nz38Jy3LVaRyFZGv8lqTNoEZnhbimCCnAAxYnaZeHTKBDyLrYrKIMeI4UcS9E+1sEk+H6GH2FphS4DAwTrP0Wh8grJFi1HwGuAeti8jgpGcBu4BFyiXjIkk4tsqAdllzgqub6C9rNwB5gjkO//5ANHCd4WvWQgXsFWGuhWwJcIhhfHvABOAnkWOj+QxqygdM1rqN24AQw32E/ecAxgrHmIfssR3CwlzMPuDtOuJXpWTXfjmwA+f02qBcjspD9Pg+Zhfc6MBiVAwSXXBOGS6oXVaAT2S6bKcrUg4fsdkViJbJ5M4rszs40VYiXYWTHODTnkSPwIAZTpjQins5N/CPZs9YOjfVxODLE32fcOfGPZLe0PqJNbtNJH/KG+YfJCskBvsdux44cZJcrRYoUIfgNHq3EbO8epBkAAAAASUVORK5CYII="/>
                </button>
              </span>
            @endif
            <input maxlength="{{ $type == 'phone' ? '10' : '' }}" type="text" class="pl-10 border border-signup-border w-full text-black" placeholder="Email ID or Mobile Number" wire:model="emailPhone">
          </div>
          <button wire:click="createUser" class="rounded-full disabled:bg-signup-border font-bold pt-2 pb-2 p-4 mt-4 disabled:text-whitish-gray text-white bg-colorx" {{ preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailPhone) || preg_match("/^\d+$/", $emailPhone) ? '' : 'disabled' }}>
            <div wire:loading.remove wire:target="createUser">
              Continue
            </div>
            <div wire:loading wire:target="createUser">
              Processing...
            </div>
          </button>
        </div>
        <div class="{{ !$mailSent ? 'hidden' : '' }}">
          <div class="text-black">
            OTP Sent to {{ $type == 'email' ? '***'.substr($emailPhone, strpos($emailPhone, '@') - 3, strlen($emailPhone)) : substr($emailPhone, 0, 1).'*****'.substr($emailPhone, 6,10) }}
          </div>
          <div class="w-full">
            <div class="relative">
              <input wire:model="enteredOtp" type="text" class="border border-signup-border w-full pr-24 text-black" placeholder="Enter OTP" maxlength="4">
              <span class="absolute inset-y-0 right-2 flex items-center pl-2">
                <button wire:click="createUser" type="submit" class="p-1 focus:outline-none focus:shadow-outline underline text-colorx text-sm">
                  <div wire:loading.remove wire:target="createUser">
                    Resend OTP
                  </div>
                  <div wire:loading wire:target="createUser">
                    Resending...
                  </div>
                </button>
              </span>
            </div>
            @if ($invalid)
              <div class="text-red-900">
                Invalid OTP
              </div>
            @endif
          </div>
          <button wire:click.prevent="verifyOtp" class="bg-colorx text-white w-1/2 font-bold rounded-full p-2 mt-4">
            Verify & {{ !$existing ? 'Create account' : 'Login' }}
          </button>
        </div>
      </div>
    </x-slot>
  </x-jet-dialog-modal>

  @livewire('front.confirm-otp')
</div>
