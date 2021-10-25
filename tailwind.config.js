module.exports = {
  mode: 'jit',
  important: false,
  purge: {
    content: [
      './resources/**/*.antlers.html',
      './resources/**/*.blade.php',
      './content/**/*.md',
      './resources/js/components/**/*.vue'
    ]
  },
  theme: {
    screens: {
      'md': '720px',  
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1440px',
      '3xl': '1680px',
      'retina': '1921px',
    }, 
    fontFamily: {
      sans: ['proxima-nova', 'sans-serif'],
      serif: ['eurostile', 'serif'],
    },
    container: {   
      center: true,     
      padding: {
        DEFAULT: '1rem',
        lg: '2rem',
        xl: '4rem',
      },
    },
    extend: {
      colors: {
        
      },      
    },
  },
  variants: {},
  plugins: [],
}
