<button
    id="backToTop"
    class="pointer-events-none fixed right-4 bottom-4 translate-y-2 transform rounded-sm bg-blue-500 p-3 text-white opacity-0 shadow-lg transition duration-300 ease-out hover:bg-blue-600 focus:outline-none"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-4"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const backToTop = document.getElementById('backToTop');

        const showBtn = () => {
            backToTop.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
            backToTop.classList.add('opacity-100', 'translate-y-0');
        };

        const hideBtn = () => {
            backToTop.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
            backToTop.classList.remove('opacity-100', 'translate-y-0');
        };

        const onScroll = () => {
            if (window.scrollY > 200) showBtn();
            else hideBtn();
        };

        window.addEventListener('scroll', onScroll);
        onScroll(); // set state awal

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>
