class Upload
  BUCKET = "XXXXXXXXXXXX"
  SAVEKEY = "XXXXXXXXXXXXXX"
  FORM_KEY = "XXXXXXXXXXXXXXXXXXXXXX"

  def self.expiration
    Time.now.to_i + 600
  end
  
  def self.policy
    Base64.strict_encode64(self.policy_json)
  end
  
  def self.policy_json
     policies = {
      "bucket" => BUCKET,
      "expiration" => expiration,
      "save-key" => SAVEKEY,
      #"return-url" => "http://localhost:3000",
      "notify-url" => "http://localhost:3000/home/upload_notify"       
    }
    policies.to_json
  end
  
  def self.signature
    Digest::MD5.hexdigest("#{self.policy}&#{FORM_KEY}")
  end
  
end