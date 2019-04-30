<template>
    <div>
        <div class="row">
            <div class="container title col d-flex flex-wrap flex-sm-nowrap justify-content-between">
                <div class="order-1">
                    <a href="/"><img :src="apeImg"/> DNSApe</a> &nbsp;
                </div>
                <div class="order-2 order-sm-3 menubuttons">
                    <button type="button" class="btn dropdown-toggle copybutton">
                      <i class="fa fa-link"></i>
                    </button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-sliders-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="mt-2">
                          <button id="dm-button" type="button" class="btn btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off" v-on:click="toggleDarkMode">
                              <div class="handle"></div>
                          </button>
                        </div>
                    </div>
                </div>
                <div class="order-3 order-sm-2 flex-fill">
                    <input id="domain" autofocus type="url" v-model="host" class="form-control" v-on:keyup.enter.prevent="formSubmit" v-on:focus="urlFocus = true" v-on:blur="urlFocus = false" autosuggest="off" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" @focus="$event.target.select()" placeholder="Domain name or IP address"></input>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form @submit.prevent="formSubmitDNS">
                    <button id="dns" class="btn btn-link mt-1">DNS Records</button>
                </form>
            </div>
            <div class="col">
                <form @submit.prevent="formSubmitTraversal">
                    <button id="traversal" class="btn btn-link mt-1">DNS Traversal</button>
                </form>
            </div>
            <div class="w-100 d-sm-none"></div>
            <div class="col">
                <form @submit.prevent="formSubmitCache">
                    <button id="cache" class="btn btn-link mt-1">DNS Cache</button>
                </form>
            </div>
            <div class="col">
                <form @submit.prevent="formSubmitHeaders">
                    <button id="headers" class="btn btn-link mt-1">HTTP Headers</button>
                </form>
            </div>
            <div class="w-100 d-lg-none"></div>
            <div class="col">
                <form @submit.prevent="formSubmitWhois">
                    <button id="whois" class="btn btn-link mt-1">Whois</button>
                </form>
            </div>
            <div class="col">
                <form @submit.prevent="formSubmitIPWhois">
                    <button id="ipwhois" class="btn btn-link mt-1">IP Whois</button>
                </form>
            </div>
            <div class="w-100 d-sm-none"></div>
            <div class="col">
                <form @submit.prevent="formSubmitSSL">
                    <button id="ssl" class="btn btn-link mt-1">SSL</button>
                </form>
            </div>
            <div class="col">
                <form @submit.prevent="formSubmitPing">
                    <button id="ping" class="btn btn-link mt-1">Ping</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col recordsLabel" v-show="recordType">
                DNS Record Type:
            </div>
        </div>

        <div class="row" v-show="recordType">
            <div class="col records">
                <select class="form-control selector mb-3 mt-2" name="record" v-model="record" v-on:change="recordChange">
                    <option value="A">A</option>
                    <option value="AAAA">AAAA</option>
                    <option value="PTR">PTR</option>
                    <option value="NS">NS</option>
                    <option value="CNAME">CNAME</option>
                    <option value="MX">MX</option>
                    <option value="TXT">TXT</option>
                    <option value="SPF">SPF</option>
                    <option value="SRV">SRV</option>
                    <option value="SOA">SOA</option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <div id="output" class="output pl-2 pr-2" v-html="output">
                    {{ output }}
                </div>
            </div>
        </div>

        <transition name="modal" v-if="showModal" @close="showModal=false">
          <div class="modal-mask">
            <div class="modal-wrapper">
              <div class="container modal-container">
                <div class="modal-header">
                    <div class="float-left">{{ modalTitle }}</div>
                    <div class="float-right" style="margin-top:-3px">
                        <button class="btn btn-link modal-default-button" @click="showModal=false">
                            X
                        </button>
                    </div>
                </div>
                <div class="modal-body" v-html="modalBody">
                    {{ modalBody }}
                </div>
                <div class="modal-footer">
                    <button class="modal-default-button btn btn-link" @click="showModal=false">
                      Close
                    </button>
                </div>
              </div>
            </div>
          </div>
        </transition>
        <hr class="homehr" v-if="!output"/>
        <div id="footer" class="container-fluid pb-2">
            <div class="float-left"><a href="" @click.prevent="showUpdates()">Updates</a>&nbsp; | &nbsp;<a href="" @click.prevent="showPrivacy()">Privacy</a>&nbsp; | &nbsp;<a href="https://github.com/srvaudit/dnsape">Github</a>&nbsp; | &nbsp;<a href="https://dnsape.featureupvote.com/?order=popular&filter=allexceptdone#controls" target="_blank">Vote on features!</a> &nbsp;</div>
            <div class="float-right">By <a href="https://srvaudit.com">srvAudit</a> Skunkworks</div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            document.onkeypress=this.keyed;
            new ClipboardJS('.copybutton', {
                text: function(trigger) {
                    return window.location.href;
                }
            });
            this.darkMode = document.head.querySelector("[name~=dark-mode][content]").content;
            if(this.darkMode == 1) {
                this.initialLoad = true;
                this.toggleDarkMode();
            }
            this.clientIP = document.getElementsByTagName("meta").item(7).content;
            if(this.$route.params.query) {
                this.host = this.$route.params.host;
                this.query = this.$route.params.query;
                this.formSubmit();
            }
        },
        data() {
            return {
                host: '',
                clientIP: '',
                record: 'A',
                recordType: false,
                query: 'dns',
                output: '',
                urlFocus: false,
                showModal: false,
                modalTitle: '',
                modalBody: '',
                darkMode: 0,
                initialLoad: false,
                apeImg: '/img/ape.png'
            };
        },
        methods: {
            whatIsMyIP(e) {
                $("#domain").val(this.clientIP);
            },
            toggleDarkMode(e) {
                var oldlink = document.getElementsByTagName("link").item(17);
                var newlink = document.createElement("link");
                newlink.setAttribute("rel", "stylesheet");
                newlink.setAttribute("type", "text/css");
                let currentObj = this;
                if(this.darkMode == 1) {
                    if(this.initialLoad == true) {
                        this.$nextTick(newlink.setAttribute("href", "/css/dark.css"));
                        this.apeImg='/img/albino-ape.png';
                        this.darkMode=true;
                        $('#dm-button').addClass('active');
                        this.initialLoad=false;
                    } else if(this.initialLoad == false) {
                        this.$nextTick(newlink.setAttribute("href", ""));
                        this.apeImg='/img/ape.png';
                        this.darkMode=false;
                        axios.post('/darkmode', {
                            enabled: false
                        })
                        .catch(function (error) {
                            alert('Error setting cookie');
                            currentObj.output = error;
                        });
                    }
                } else {
                    this.$nextTick(newlink.setAttribute("href", "/css/dark.css"));
                    this.apeImg='/img/albino-ape.png';
                    this.darkMode=true;
                    axios.post('/darkmode', {
                        enabled: true
                    })
                    .catch(function (error) {
                        alert('Error setting cookie');
                        currentObj.output = error;
                    });
                }
                document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink);
            },
            checkDomainAndIP(domain) {
                if (this.checkDomain(domain, 1) || this.checkIP(domain, 1)) {
                    return true;
                } else {
                    alert("Please provide a valid domain or IP.");
                    return false;
                }
            },
            checkDomain(domain, cdai) {
                if (/^\w+([\.-]?\w+)*(\.\w{2,10})+$/.test(domain)) {
                    return true;
                } else if (cdai) {
                    return false;
                } else {
                    alert("Please provide a valid domain.");
                    return false;
                }
            },
            checkIP(ip, cdai) {
                if (/^\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/.test(ip)) {
                    return true;
                } else if (cdai) {
                    return false;
                } else {
                    alert("Please provide a valid IP.");
                    return false;
                }
            },
            recordChange:function() {
                switch(this.query) {
                    case 'traversal':
                        this.formSubmitTraversal(this.record)
                        break
                    case 'cache':
                        this.formSubmitCache(this.record)
                        break
                }
            },
            formSubmit(e) {
                let currentObj = this;
                switch(this.query) {
                    case 'dns':
                        this.formSubmitDNS()
                        break
                    case 'traversal':
                        this.formSubmitTraversal()
                        break
                    case 'cache':
                        this.formSubmitCache()
                        break
                    case 'headers':
                        this.formSubmitHeaders()
                        break
                    case 'whois':
                        this.formSubmitWhois()
                        break
                    case 'ipwhois':
                        this.formSubmitIPWhois()
                        break
                    case 'ssl':
                        this.formSubmitSSL()
                        break
                    case 'ping':
                        this.formSubmitPing()
                        break
                }
            },
            pushRoute() {
                let currentObj = this;
                let query = currentObj.query;
                let lookupHost = currentObj.host;
                this.$router.push({ name: 'dns', params: { query: query, host: lookupHost } });
            },
            formSubmitDNS(e) {
                NProgress.start();
                let currentObj = this;
                currentObj.query='dns';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=false;
                $("#dns").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomain(this.host) == true) {
                    axios.post('/dns', {
                        host: this.host,
                    })
                    .then(function (response) {
                        $("#output").addClass("response-box");
                        currentObj.output = response.data;
                        //mixpanel.track("DNS Records");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitTraversal(e) {
                NProgress.start();
                let currentObj = this;
                $("#output").addClass("response-box");
                currentObj.output = "<br/>Stand by, this takes a few seconds...<br/><br/>"
                currentObj.query='traversal';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                $("#traversal").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                this.recordType=true;
                NProgress.inc();
                if(this.checkDomain(this.host) == true) {
                    axios.post('/traversal', {
                        host: this.host,
                        record: this.record,
                    })
                    .then(function (response) {
                        currentObj.output = response.data;
                        //mixpanel.track("DNS Traversal");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitCache(e) {
                NProgress.start();
                let currentObj = this;
                currentObj.output = "<br/>Stand by, this takes a few seconds...<br/><br/>"
                currentObj.query='cache';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=true;
                $("#cache").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomain(this.host) == true) {
                    axios.post('/cache', {
                        host: this.host,
                        record: this.record,
                    })
                    .then(function (response) {
                        $("#output").addClass("response-box");
                        currentObj.output = response.data;
                        //mixpanel.track("DNS Cache");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitHeaders(e) {
                NProgress.start();
                let currentObj = this;
                currentObj.query='headers';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=false;
                $("#headers").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomainAndIP(this.host) == true) {
                    axios.post('/httpheaders', {
                        host: this.host,
                    })
                    .then(function (response) {
                        $("#output").addClass("response-box");
                        currentObj.output = response.data;
                        //mixpanel.track("HTTP Headers");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitWhois(e) {
                NProgress.start();
                let currentObj = this;
                currentObj.query='whois';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=false;
                $("#whois").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomain(this.host) == true) {
                    axios.post('/whois', {
                        host: this.host,
                    })
                    .then(function (response) {
                        $("#output").addClass("response-box");
                        currentObj.output = response.data;
                        //mixpanel.track("Whois");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitIPWhois(e) {
                NProgress.start();
                let currentObj = this;
                currentObj.query='ipwhois';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=false;
                $("#ipwhois").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomainAndIP(this.host) == true) {
                    axios.post('/ipwhois', {
                        host: this.host,
                    })
                    .then(function (response) {
                        $("#output").addClass("response-box");
                        currentObj.output = response.data;
                        //mixpanel.track("IP Whois");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitSSL(e) {
                NProgress.start();
                let currentObj = this;
                $("#output").addClass("response-box");
                currentObj.query='ssl';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=false;
                $("#ssl").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomainAndIP(this.host) == true) {
                    axios.post('/ssl', {
                        host: this.host,
                    })
                    .then(function (response) {
                        currentObj.output = response.data;
                        //mixpanel.track("SSL");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            formSubmitPing(e) {
                NProgress.start();
                let currentObj = this;
                currentObj.output = "<br/>Wait 4 seconds...<br/><br/>"
                $("#output").addClass("response-box");
                currentObj.query='ping';
                currentObj.pushRoute();
                $(".btn").removeClass("active");
                this.recordType=false;
                $("#ping").addClass("active");
                if(this.darkMode == true) {
                    $('#dm-button').addClass('active');
                }
                NProgress.inc();
                if(this.checkDomainAndIP(this.host) == true) {
                    axios.post('/ping', {
                        host: this.host,
                    })
                    .then(function (response) {
                        currentObj.output = response.data;
                        //mixpanel.track("Ping");
                        NProgress.done();
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                    $('#domain').blur();
                } else {
                    NProgress.done();
                }
            },
            keyed(e){
                if (this.urlFocus == false) {
                    var evtobj=window.event? event : e
                    var unicode=evtobj.charCode? evtobj.charCode : evtobj.keyCode
                    var actualkey=String.fromCharCode(unicode)
                    if (actualkey=="d")
                        this.formSubmitDNS();
                    if (actualkey=="t")
                        this.formSubmitTraversal();
                    if (actualkey=="c")
                        this.formSubmitCache();
                    if (actualkey=="h")
                        this.formSubmitHeaders();
                    if (actualkey=="w")
                        this.formSubmitWhois();
                    if (actualkey=="i")
                        this.formSubmitIPWhois();
                    if (actualkey=="r")
                        this.formSubmitSSL();
                    if (actualkey=="p")
                        this.formSubmitPing();
                    if (actualkey=="a")
                        document.body.style.fontSize="120%"
                    if (actualkey=="z")
                        document.body.style.fontSize="100%"
                    if (actualkey=="v")
                        domainlink();
                    if (actualkey=="l"){
                        document.getElementById('domain').focus();
                        document.getElementById('domain').select();
                    }
                }
            },
            showUpdates(e) {
                this.showModal=true;
                let currentObj = this;
                axios.get('/updates')
                .then(function (response) {
                    currentObj.modalBody = response.data;
                    currentObj.modalTitle = "DNSApe Updates";
                    //mixpanel.track("Updates");
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            },
            showPrivacy(e) {
                this.showModal=true;
                let currentObj = this;
                axios.get('/privacy')
                .then(function (response) {
                    currentObj.modalBody = response.data;
                    currentObj.modalTitle = "DNSApe Privacy Policy";
                    //mixpanel.track("Updates");
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>
