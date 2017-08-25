/**
 * Player HTML5
 * @param elem  domNode Video
 * @author Claire Sosset (claire.sosset@gmail.com || @claire_so)
 **/
var oo = function (oo, my, document) {

    oo.component = oo.component || {};
    oo.component = {};

    var ooPlayer = my.Class({
        STATIC: {},
        constructor: function (elem) {
            this.elem = elem;
            this.timeline = null;
            this.progress = null;
            this.playPauseButton = null;
            this.muteButton = null;
            this.isPlaying = false;
            if (arguments[1]) {
               this.playPauseButton = arguments[1];
            }
            
            if (arguments[2]) {
               this.muteButton = arguments[2];
            }

            this.attachEvents();
            this.buildTimeline();
            
        },
        attachEvents : function attachEvents() {
            var that = this;

            if (this.playPauseButton) {
                Events.addListener(oo.Button.EVT_TOUCH, function () {
                       that.togglePlay();
                }, that.playPauseButton);
            }
            
            if (this.muteButton){
                Events.addListener(oo.Button.EVT_TOUCH, function () {
                       that.toggleMute();
                }, that.muteButton);
            }
            
            function end(){
                that.elem.currentTime = 0;
            }
            
            this.elem.addEventListener('ended', end, false);
        },
        togglePlay : function playPause() {
            this.elem[(this.elem.paused) ? 'play' : 'pause']();
            
            if (this.elem.paused){
                this.playPauseButton._dom.classList.addClass('paused');
                this.playPauseButton._dom.classList.removeClass('playing');
                this.isPlaying = false;
            } else {
                this.playPauseButton._dom.classList.addClass('playing');
                this.playPauseButton._dom.classList.removeClass('paused');
                this.isPlaying = true;
            }
        },
        toggleMute : function toggleMute() {
            this.elem.muted = !this.elem.muted;
            this.muteButton._dom.classList[(this.elem.muted)? 'addClass': 'removeClass']('btn-muted');
        },
        buildTimeline : function buildTimeline() {
            var _this = this,
            doc = document,
            frag = doc.createDocumentFragment(),
            wrapper = document.createElement('div');
            wrapper.setAttribute('id', 'ooPlayer-timeline');
            this.timeline = document.createElement('div');
            this.timeline.setAttribute('id', 'ooPlayer-timeline-progress');
            this.progress = document.createElement('div');
            this.progress.setAttribute('id', 'ooPlayer-timeline-load-progress');

            wrapper.appendChild(this.timeline);
            wrapper.appendChild(this.progress);
            frag.appendChild(wrapper);

            function timeupdate() {
                _this.updateTimeline.apply(_this);
            }
            this.elem.addEventListener('timeupdate', timeupdate, false);

            function progress(e) {
                _this.progressHandler.call(_this, e);
            }

            this.elem.addEventListener('progress', progress, false);

            this.elem.parentNode.appendChild(frag);
        },
        updateTimeline : function updateTimeline() {
            var progress = parseInt(this.elem.currentTime * 100 / this.elem.duration, 10);
            this.timeline.style.width = [progress, '%'].join('');
        },
        progressHandler : function progressHandler() {
            var endBuf = this.elem.buffered.end(0),
                progress = parseInt(((endBuf / this.elem.duration) * 100), 10);
            this.progress.style.width = [progress, '%'].join('');
        }

    });

    var exports = oo.core.utils.getNS('oo.Components');
    exports.ooPlayer = ooPlayer;
    
    return oo;
}(oo || {}, my, document);