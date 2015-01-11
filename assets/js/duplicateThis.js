$.fn.duplicateThis = function(child){

    var o_class = 'original_element';
    var d_class = 'duplicated_element';

    elements = [];

    var top_index = 0;

    function duplicate(el, child, parent, level){

        var o = {elements: []};

        o.init = function(){
            var pos_marker = $('<div></div>');
            var wrapper = $('<div class="duplicateThis_wrapper"></div>');
            var original_element = $('<div></div>');
            var target_element = el;

            pos_marker.insertAfter(target_element);

            target_element.detach();
            target_element.appendTo(original_element);
            original_element.addClass(o_class);

            wrapper.insertAfter(pos_marker);
            pos_marker.remove();

            this.wrapper = wrapper;
            this.o_el = original_element;

            return o;
        };

        o.add_element = function(element){
            this.elements.push(element);
        };

        o.remove_element = function(index){
            var self = this;
            for(var i = 0;i < self.elements.length;i++){
                if(self.elements[i].attr('id') == index){
                    self.elements[i].fadeOut('slow', function(){
                        $(this).find('input').each(function(){
                            for(var i = 0;i < elements.length;i++){
                                if(elements[i].content === this){
                                    elements.splice(elements.indexOf(elements[i]), 1);
                                }
                            }
                        });
                        this.remove();
                    });
                    var the_index = self.elements.indexOf(self.elements[i]);
                    if(the_index > -1){
                        self.elements.splice(the_index, 1);
                    }
                    break;
                }
            }
        }

        o.get_inputs = function(e){
            var inputs = $(e).find('input');
            for(var i = 0;i < inputs.length;i++){
                var input_registered = false;
                for(var _i = 0;_i < elements.length;_i++){
                    if(inputs[i] === elements[_i].content){
                        input_registered = true;
                    }
                }
                if(!input_registered){
                    elements.push({top_level: 0, level: level, content: inputs[i]});
                }
            }
        }

        o.generate = function(){

            var self = this;
            var element = self.o_el.clone();

            if(typeof child !== 'undefined'){
                var c_e = element.find(child.selector);
                duplicate(c_e, child.nested, self, level+1);
            }

            element.change_trigger_function = function(){
                var count = self.elements.length;
                var last_index = count - 1;
                for(var i = 0; i < count; i++){
                    var current_element = self.elements[i];
                    var trigger = current_element.get_trigger();
                    var the_index = self.elements.indexOf(current_element);
                    if(i < last_index){
                        $(trigger).removeClass('glyphicon-plus').addClass('glyphicon-minus');
                    }
                }
            }

            element.create_trigger = function(p){
                var trigger = $('<span class="glyphicon glyphicon-plus"></span>');
                trigger.click(function(){
                    if($(this).hasClass('glyphicon-plus')){
                        o.generate();
                    }else{
                        o.remove_element(p.attr('id'));
                    }
                });
                trigger.appendTo(p);
                return trigger;
            }

            element.uniqueId();
            element.fadeIn();
            element.appendTo(self.wrapper);
            element.removeClass(o_class).addClass(d_class);
            self.add_element(element);
            var trigger = element.create_trigger(element);
            element.get_trigger = function(){
                return trigger;
            }
            element.change_trigger_function();

            var result_element = element[0];
            o.get_inputs(result_element);
        };

        o.init();
        o.generate();

        return elements;
    }

    return duplicate(this, child, false, 0);
}
