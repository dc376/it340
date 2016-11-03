# -*- encoding: utf-8 -*-
# stub: logstash-output-elasticsearch_http 0.0.2 ruby lib

Gem::Specification.new do |s|
  s.name = "logstash-output-elasticsearch_http"
  s.version = "0.0.2"

  s.required_rubygems_version = Gem::Requirement.new(">= 0") if s.respond_to? :required_rubygems_version=
  s.metadata = { "logstash_group" => "output", "logstash_plugin" => "true" } if s.respond_to? :metadata=
  s.require_paths = ["lib"]
  s.authors = ["Elastic"]
  s.date = "2015-04-20"
  s.description = "The elasticsearch_http output is deprecated in favor of the elasticsearch output with the protocol set to http"
  s.email = "info@elastic.co"
  s.homepage = "http://www.elastic.co/guide/en/logstash/current/index.html"
  s.licenses = ["Apache License (2.0)"]
  s.rubygems_version = "2.4.6"
  s.summary = "The elasticsearch_http output is deprecated in favor of the elasticsearch"

  s.installed_by_version = "2.4.6" if s.respond_to? :installed_by_version

  if s.respond_to? :specification_version then
    s.specification_version = 4

    if Gem::Version.new(Gem::VERSION) >= Gem::Version.new('1.2.0') then
      s.add_runtime_dependency(%q<logstash-core>, ["< 2.0.0", ">= 1.4.0"])
      s.add_runtime_dependency(%q<logstash-output-elasticsearch>, [">= 0"])
      s.add_runtime_dependency(%q<logstash-codec-plain>, [">= 0"])
      s.add_development_dependency(%q<logstash-devutils>, [">= 0"])
    else
      s.add_dependency(%q<logstash-core>, ["< 2.0.0", ">= 1.4.0"])
      s.add_dependency(%q<logstash-output-elasticsearch>, [">= 0"])
      s.add_dependency(%q<logstash-codec-plain>, [">= 0"])
      s.add_dependency(%q<logstash-devutils>, [">= 0"])
    end
  else
    s.add_dependency(%q<logstash-core>, ["< 2.0.0", ">= 1.4.0"])
    s.add_dependency(%q<logstash-output-elasticsearch>, [">= 0"])
    s.add_dependency(%q<logstash-codec-plain>, [">= 0"])
    s.add_dependency(%q<logstash-devutils>, [">= 0"])
  end
end
