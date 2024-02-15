@extends('backend.layouts.master')
@section('title', 'E-SHOP || Banner Page')
@section('main-content')
<!-- DataTales Example -->
<div class="card  mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Menu List</h6>
        <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
            data-placement="bottom" title="Add Menu"><i class="fas fa-plus"></i> Add Menu</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 drack">
            <div class="dd nestable" id="nestable">
                <form method="post" action="{{ route('menus.drackanddrop') }}">
                    @csrf
                    <ol class="dd-list">
                        @foreach ($menus as $menu)
                        @php $isActive = $menu->status ? 1 : 0; @endphp
                        <li class="dd-item" data-id="{{ $menu->id }}" data-name="{{ $menu->name }}"
                            data-slug="services-slug-{{ $menu->id }}" data-new="0" data-deleted="0">
                            <div class="dd-handle">{{ $menu->name }}</div>
                            <input type="hidden" name="menus[{{ $menu->id }}][id]" value="{{ $menu->id }}">
                            <input type="hidden" name="menus[{{ $menu->id }}][name]" value="{{ $menu->name }}">
                            <span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="{{ $menu->id }}">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <span class="button-edit btn btn-success btn-xs pull-right">
                                <a href="{{ route('menus.edit', $menu->id) }}"><i class="fa fa-pencil"
                                        aria-hidden="true"></i></a>
                            </span>
                            @if ($isActive)
                                <span class="button-active btn btn-primary btn-xs pull-right active-btn-sec">
                                    Active
                                </span>
                            @else
                                <span class="button-inactive btn btn-warning btn-xs pull-right active-btn-sec Inactive">
                                    Inactive
                                </span>
                            @endif
                            @php $submenus = Helper::subMenus($menu->id); @endphp
                            @if ($submenus->isNotEmpty())
                            <ol class="dd-list">
                                @foreach ($submenus as $submenu)
                                @php $isActive = $submenu->status ? 1 : 0; @endphp
                                <li class="dd-item" data-id="{{ $submenu->id }}" data-name="{{ $submenu->name }}"
                                    data-slug="uiux-slug-{{ $submenu->name }}" data-new="0" data-deleted="0">
                                    <div class="dd-handle">{{ $submenu->name }}</div>
                                    <input type="hidden" name="menus[{{ $menu->id }}][submenus][{{ $submenu->id }}][id]" value="{{ $submenu->id }}">
                                    <input type="hidden" name="menus[{{ $menu->id }}][submenus][{{ $submenu->id }}][name]" value="{{ $submenu->name }}">
                                    <span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="{{ $menu->id }}">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                                    <span class="button-edit btn btn-success btn-xs pull-right">
                                        <a href="{{ route('menus.edit', $submenu->id) }}"><i class="fa fa-pencil"
                                                aria-hidden="true"></i></a>
                                    </span>
                                    @if ($isActive)
                                        <span class="button-active btn btn-primary btn-xs pull-right active-btn-sec">
                                            Active
                                        </span>
                                    @else
                                        <span class="button-inactive btn btn-warning btn-xs pull-right active-btn-sec Inactive">
                                            Inactive
                                        </span>
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                            @endif
                        </li>
                        @endforeach
                    </ol>
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')
<!-- Page level plugins -->
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
<script>
    var updateOutput = function(e) {
      var list = e.length ? e : $(e.target),
        output = list.data('output');
      if (window.JSON) {
        if (output) {
          output.val(window.JSON.stringify(list.nestable('serialize')));
        }
      } else {
        alert('JSON browser support required for this page.');
      }
    };

    $(function() {
      updateOutput($('#nestable').data('output', $('#json-output')));
      editButton.on("click", editMenuItem);
      $("#nestable .button-delete").on("click", deleteFromMenu);
      $("#nestable .button-edit").on("click", prepareEdit);
      $("#menu-editor").submit(function(e) {
        e.preventDefault();
      });
      $("#menu-add").submit(function(e) {
        e.preventDefault();
        addToMenu();
      });
    });


    ;
    (function($, window, document, undefined) {
      var hasTouch = 'ontouchstart' in document;
      var hasPointerEvents = (function() {
        var el = document.createElement('div'),
          docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
          return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
      })();

      var defaults = {
        listNodeName: 'ol',
        itemNodeName: 'li',
        rootClass: 'dd',
        listClass: 'dd-list',
        itemClass: 'dd-item',
        dragClass: 'dd-dragel',
        handleClass: 'dd-handle',
        collapsedClass: 'dd-collapsed',
        placeClass: 'dd-placeholder',
        noDragClass: 'dd-nodrag',
        emptyClass: 'dd-empty',
        expandBtnHTML: '<button data-action="expand" type="button">Expand</button>',
        collapseBtnHTML: '<button data-action="collapse" type="button">Collapse</button>',
        group: 0,
        maxDepth: 5,
        threshold: 20
      };

      function Plugin(element, options) {
        this.w = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
      }

      Plugin.prototype = {

        init: function() {
          var list = this;

          list.reset();

          list.el.data('nestable-group', this.options.group);

          list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

          $.each(this.el.find(list.options.itemNodeName), function(k, el) {
            list.setParent($(el));
          });

          list.el.on('click', 'button', function(e) {
            if (list.dragEl) {
              return;
            }
            var target = $(e.currentTarget),
              action = target.data('action'),
              item = target.parent(list.options.itemNodeName);
            if (action === 'collapse') {
              list.collapseItem(item);
            }
            if (action === 'expand') {
              list.expandItem(item);
            }
          });

          var onStartEvent = function(e) {
            var handle = $(e.target);
            if (!handle.hasClass(list.options.handleClass)) {
              if (handle.closest('.' + list.options.noDragClass).length) {
                return;
              }
              handle = handle.closest('.' + list.options.handleClass);
            }

            if (!handle.length || list.dragEl) {
              return;
            }

            list.isTouch = /^touch/.test(e.type);
            if (list.isTouch && e.touches.length !== 1) {
              return;
            }

            e.preventDefault();
            list.dragStart(e.touches ? e.touches[0] : e);
          };

          var onMoveEvent = function(e) {
            if (list.dragEl) {
              e.preventDefault();
              list.dragMove(e.touches ? e.touches[0] : e);
            }
          };

          var onEndEvent = function(e) {
            if (list.dragEl) {
              e.preventDefault();
              list.dragStop(e.touches ? e.touches[0] : e);
            }
          };

          if (hasTouch) {
            list.el[0].addEventListener('touchstart', onStartEvent, false);
            window.addEventListener('touchmove', onMoveEvent, false);
            window.addEventListener('touchend', onEndEvent, false);
            window.addEventListener('touchcancel', onEndEvent, false);
          }

          list.el.on('mousedown', onStartEvent);
          list.w.on('mousemove', onMoveEvent);
          list.w.on('mouseup', onEndEvent);

        },

        serialize: function() {
          var data,
            depth = 0,
            list = this;
          step = function(level, depth) {
            var array = [],
              items = level.children(list.options.itemNodeName);
            items.each(function() {
              var li = $(this),
                item = $.extend({}, li.data()),
                sub = li.children(list.options.listNodeName);
              if (sub.length) {
                item.children = step(sub, depth + 1);
              }
              array.push(item);
            });
            return array;
          };
          data = step(list.el.find(list.options.listNodeName).first(), depth);
          return data;
        },

        serialise: function() {
          return this.serialize();
        },

        reset: function() {
          this.mouse = {
            offsetX: 0,
            offsetY: 0,
            startX: 0,
            startY: 0,
            lastX: 0,
            lastY: 0,
            nowX: 0,
            nowY: 0,
            distX: 0,
            distY: 0,
            dirAx: 0,
            dirX: 0,
            dirY: 0,
            lastDirX: 0,
            lastDirY: 0,
            distAxX: 0,
            distAxY: 0
          };
          this.isTouch = false;
          this.moving = false;
          this.dragEl = null;
          this.dragRootEl = null;
          this.dragDepth = 0;
          this.hasNewRoot = false;
          this.pointEl = null;
        },

        expandItem: function(li) {
          li.removeClass(this.options.collapsedClass);
          li.children('[data-action="expand"]').hide();
          li.children('[data-action="collapse"]').show();
          li.children(this.options.listNodeName).show();
        },

        collapseItem: function(li) {
          var lists = li.children(this.options.listNodeName);
          if (lists.length) {
            li.addClass(this.options.collapsedClass);
            li.children('[data-action="collapse"]').hide();
            li.children('[data-action="expand"]').show();
            li.children(this.options.listNodeName).hide();
          }
        },

        expandAll: function() {
          var list = this;
          list.el.find(list.options.itemNodeName).each(function() {
            list.expandItem($(this));
          });
        },

        collapseAll: function() {
          var list = this;
          list.el.find(list.options.itemNodeName).each(function() {
            list.collapseItem($(this));
          });
        },

        setParent: function(li) {
          if (li.children(this.options.listNodeName).length) {
            li.prepend($(this.options.expandBtnHTML));
            li.prepend($(this.options.collapseBtnHTML));
          }
          li.children('[data-action="expand"]').hide();
        },

        unsetParent: function(li) {
          li.removeClass(this.options.collapsedClass);
          li.children('[data-action]').remove();
          li.children(this.options.listNodeName).remove();
        },

        dragStart: function(e) {
          var mouse = this.mouse,
            target = $(e.target),
            dragItem = target.closest(this.options.itemNodeName);

          this.placeEl.css('height', dragItem.height());

          mouse.offsetX = e.offsetX !== undefined ? e.offsetX : e.pageX - target.offset().left;
          mouse.offsetY = e.offsetY !== undefined ? e.offsetY : e.pageY - target.offset().top;
          mouse.startX = mouse.lastX = e.pageX;
          mouse.startY = mouse.lastY = e.pageY;

          this.dragRootEl = this.el;

          this.dragEl = $(document.createElement(this.options.listNodeName)).addClass(this.options.listClass + ' ' +
            this.options.dragClass);
          this.dragEl.css('width', dragItem.width());

          dragItem.after(this.placeEl);
          dragItem[0].parentNode.removeChild(dragItem[0]);
          dragItem.appendTo(this.dragEl);

          $(document.body).append(this.dragEl);
          this.dragEl.css({
            'left': e.pageX - mouse.offsetX,
            'top': e.pageY - mouse.offsetY
          });
          // total depth of dragging item
          var i, depth,
            items = this.dragEl.find(this.options.itemNodeName);
          for (i = 0; i < items.length; i++) {
            depth = $(items[i]).parents(this.options.listNodeName).length;
            if (depth > this.dragDepth) {
              this.dragDepth = depth;
            }
          }
        },

        dragStop: function(e) {
          var el = this.dragEl.children(this.options.itemNodeName).first();
          el[0].parentNode.removeChild(el[0]);
          this.placeEl.replaceWith(el);

          this.dragEl.remove();
          this.el.trigger('change');
          if (this.hasNewRoot) {
            this.dragRootEl.trigger('change');
          }
          this.reset();
        },

        dragMove: function(e) {
          var list, parent, prev, next, depth,
            opt = this.options,
            mouse = this.mouse;

          this.dragEl.css({
            'left': e.pageX - mouse.offsetX,
            'top': e.pageY - mouse.offsetY
          });

          
          mouse.lastX = mouse.nowX;
          mouse.lastY = mouse.nowY;
          
          mouse.nowX = e.pageX;
          mouse.nowY = e.pageY;
          
          mouse.distX = mouse.nowX - mouse.lastX;
          mouse.distY = mouse.nowY - mouse.lastY;
          
          mouse.lastDirX = mouse.dirX;
          mouse.lastDirY = mouse.dirY;
          
          mouse.dirX = mouse.distX === 0 ? 0 : mouse.distX > 0 ? 1 : -1;
          mouse.dirY = mouse.distY === 0 ? 0 : mouse.distY > 0 ? 1 : -1;
          
          var newAx = Math.abs(mouse.distX) > Math.abs(mouse.distY) ? 1 : 0;

          
          if (!mouse.moving) {
            mouse.dirAx = newAx;
            mouse.moving = true;
            return;
          }

          
          if (mouse.dirAx !== newAx) {
            mouse.distAxX = 0;
            mouse.distAxY = 0;
          } else {
            mouse.distAxX += Math.abs(mouse.distX);
            if (mouse.dirX !== 0 && mouse.dirX !== mouse.lastDirX) {
              mouse.distAxX = 0;
            }
            mouse.distAxY += Math.abs(mouse.distY);
            if (mouse.dirY !== 0 && mouse.dirY !== mouse.lastDirY) {
              mouse.distAxY = 0;
            }
          }
          mouse.dirAx = newAx;

          
          if (mouse.dirAx && mouse.distAxX >= opt.threshold) {
            
            mouse.distAxX = 0;
            prev = this.placeEl.prev(opt.itemNodeName);
            if (mouse.distX > 0 && prev.length && !prev.hasClass(opt.collapsedClass)) {
              list = prev.find(opt.listNodeName).last();
              depth = this.placeEl.parents(opt.listNodeName).length;
              if (depth + this.dragDepth <= opt.maxDepth) {
                if (!list.length) {
                  list = $('<' + opt.listNodeName + '/>').addClass(opt.listClass);
                  list.append(this.placeEl);
                  prev.append(list);
                  this.setParent(prev);
                } else {
                  list = prev.children(opt.listNodeName).last();
                  list.append(this.placeEl);
                }
              }
            }
            if (mouse.distX < 0) {
              next = this.placeEl.next(opt.itemNodeName);
              if (!next.length) {
                parent = this.placeEl.parent();
                this.placeEl.closest(opt.itemNodeName).after(this.placeEl);
                if (!parent.children().length) {
                  this.unsetParent(parent.parent());
                }
              }
            }
          }

          var isEmpty = false;

          if (!hasPointerEvents) {
            this.dragEl[0].style.visibility = 'hidden';
          }
          this.pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY - (window
            .pageYOffset || document.documentElement.scrollTop)));
          if (!hasPointerEvents) {
            this.dragEl[0].style.visibility = 'visible';
          }
          if (this.pointEl.hasClass(opt.handleClass)) {
            this.pointEl = this.pointEl.parent(opt.itemNodeName);
          }
          if (this.pointEl.hasClass(opt.emptyClass)) {
            isEmpty = true;
          } else if (!this.pointEl.length || !this.pointEl.hasClass(opt.itemClass)) {
            return;
          }

          
          var pointElRoot = this.pointEl.closest('.' + opt.rootClass),
            isNewRoot = this.dragRootEl.data('nestable-id') !== pointElRoot.data('nestable-id');

          
          if (!mouse.dirAx || isNewRoot || isEmpty) {
            if (isNewRoot && opt.group !== pointElRoot.data('nestable-group')) {
              return;
            }
            depth = this.dragDepth - 1 + this.pointEl.parents(opt.listNodeName).length;
            if (depth > opt.maxDepth) {
              return;
            }
            var before = e.pageY < (this.pointEl.offset().top + this.pointEl.height() / 2);
            parent = this.placeEl.parent();
            if (isEmpty) {
              list = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
              list.append(this.placeEl);
              this.pointEl.replaceWith(list);
            } else if (before) {
              this.pointEl.before(this.placeEl);
            } else {
              this.pointEl.after(this.placeEl);
            }
            if (!parent.children().length) {
              this.unsetParent(parent.parent());
            }
            if (!this.dragRootEl.find(opt.itemNodeName).length) {
              this.dragRootEl.append('<div class="' + opt.emptyClass + '"/>');
            }
            if (isNewRoot) {
              this.dragRootEl = pointElRoot;
              this.hasNewRoot = this.el[0] !== this.dragRootEl[0];
            }
          }
        }

      };
      $.fn.nestable = function(params) {
        var lists = this,
          retval = this;
        lists.each(function() {
          var plugin = $(this).data("nestable");
          if (!plugin) {
            $(this).data("nestable", new Plugin(this, params));
            $(this).data("nestable-id", new Date().getTime());
          } else {
            if (typeof params === 'string' && typeof plugin[params] === 'function') {
              retval = plugin[params]();
            }
          }
        });
        return retval || lists;
      };
    })(window.jQuery || window.Zepto, window, document);

    $(function() {
        $("#menu-list").sortable({
            handle: '.dd-handle',
            update: function(event, ui) {
                updateSubmenuInputNames();
                updateFormFields();
            }
        });

        function updateFormFields() {
            $("#menu-list .dd-item").each(function(menuIndex) {
                $(this).find("input[name^='menus']").each(function() {
                    $(this).attr("name", $(this).attr("name").replace(/\[\d+\]/, "[" + menuIndex + "]"));
                });

                $(this).find(".dd-list .dd-item").each(function(submenuIndex) {
                    $(this).find("input[name^='menus']").each(function() {
                        $(this).attr("name", $(this).attr("name").replace(/\[\d+\]/g, "[" + menuIndex + "][submenus][" + submenuIndex + "]"));
                    });
                });
            });
        }

        $("form").submit(function() {
            updateFormFields();
        });
    });
</script>
@endpush