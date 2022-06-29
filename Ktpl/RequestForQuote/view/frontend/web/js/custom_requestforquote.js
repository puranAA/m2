require(
        [
            'jquery',
            'Magento_Ui/js/modal/modal'
        ],
        function(
            $,
            modal
        ) {
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                buttons: [{
                    text: $.mage.__('Close'),
                    class: 'mymodal1',
                    click: function () {
                        this.closeModal();
                    }
                }]
            };
			
			$("#popupButton").on('click',function(){	
				var popup = modal(options, $('#myModal'));								  
				$("#myModal").modal("openModal");
			});
			
			$(".popupButton2").on('click',function(){
				var popup = modal(options, $('.myModal2'));								   	
				$(".myModal2").modal("openModal");
			});
        });