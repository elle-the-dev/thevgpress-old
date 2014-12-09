(function(wysihtml5) {
  var REG_EXP = /wysiwyg-bg-color-[0-9a-z\-]+/g;
  
  wysihtml5.commands.bgColor = {
    exec: function(composer, command, size) {
      return wysihtml5.commands.formatInline.exec(composer, command, "span", "wysiwyg-bg-color-" + size, REG_EXP);
    },

    state: function(composer, command, size) {
      return wysihtml5.commands.formatInline.state(composer, command, "span", "wysiwyg-bg-color-" + size, REG_EXP);
    }
  };
})(wysihtml5);
