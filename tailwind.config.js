module.exports = {
  // use preflight (reset CSS) override fonts size from theme.json
  corePlugins: {
    preflight: false,
  },
  content: ['./**/*.{php,twig,html}', './assets/*.{js,jsx,ts,tsx,vue}'],
  safelist: [],
  theme: {
    fontFamily: {
      display: ['var(--wp--preset--font-family--sora)'],
      body: ['var(--wp--preset--font-family--lora)'],
    },
    extend: {
      gridTemplateColumns: {
        main: '8rem 1fr 8rem',
        'main-small': '1rem 1fr 1rem',
      },
      maxWidth: {
        'custom-content': 'var(--wp--custom--sizes--content)',
      },
      backgroundImage: (theme) => ({
        'wp-performance': "url('/assets/media/wp-performance.png')",
        'link-gradient': 'linear-gradient(to left,#BE185D,rgb(150,20,90));',
      }),
      colors: {
        body: 'var(--wp--custom--colors--body)',
        primary: 'var(--wp--preset--color--primary)',
        accent: 'var(--wp--preset--color--accent)',
      },
      animation: {
        'text-gradient': 'tgradient-text 5s ease infinite',
      },
      keyframes: {
        'text-gradient': {
          '0%, 100%': {
            'background-size': '200% 200%',
            'background-position': 'left center',
          },
          '50%': {
            'background-size': '200% 200%',
            'background-position': 'right center',
          },
        },
      },
    },
  },
  variants: {
    scrollbar: ['rounded'],
  },
  plugins: [require('tailwind-scrollbar')({ nocompatible: true })],
}
