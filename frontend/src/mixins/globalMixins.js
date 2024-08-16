const globalMixins = {    
  methods: { 
    characterLimiter: function(text, numberOfCharacter) {
      // Limiting the number of characters 
      text = text.substring(numberOfCharacter, 0)
      return text || ""        
    },
  }
}

export default globalMixins