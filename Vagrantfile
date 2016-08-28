# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "ubuntu/xenial64"
  config.ssh.forward_agent = true

  config.vm.post_up_message = post_message

  # Fix for: "stdin: is not a tty"
  # https://github.com/mitchellh/vagrant/issues/1673#issuecomment-28288042
  config.ssh.shell = %{bash -c 'BASH_ENV=/etc/profile exec bash'}

  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "private_network", ip: "192.168.33.10", hostsupdater: 'skip'
  config.vm.host_name = "tgc.dev"

  if !Vagrant.has_plugin? 'vagrant-vbguest'
    fail_with_message "vagrant-vbguest missing, please install the plugin with this command:\nvagrant plugin install vagrant-vbguest"
  end

  config.vm.provider "virtualbox" do |vb|
    # Customize the amount of memory on the VM:
    vb.memory = "1024"
    vb.name = "the-globe-church"
  end

  config.vm.synced_folder ".", "/vagrant", :mount_options => ['dmode=774','fmode=775']
  config.vm.synced_folder "www/", "/var/www/html"

  config.vm.provision :shell, :path => "bootstrap.sh"
end

def post_message
  msg = "You are up an running.\n"
  msg << "Let's go from http://192.168.33.10/"
  msg << "Or perhaps add something clever to your hosts file..."

  msg
end
