using System;
using System.Collections.Generic;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class User
    {
        public User()
        {
            idUser = Guid.NewGuid();
        }

        [DataMember]
        public Guid idUser { get; set; }
        [DataMember]
        public String name { get; set; }
        [DataMember]
        public DateTime birthDate { get; set; }
        [DataMember]
        public String email { get; set; }
        [DataMember]
        public String phone { get; set; }
        [DataMember]
        public String password { get; set; }
        [DataMember]
        public int credits { get; set; }
        [DataMember]
        public int range { get; set; }
        [DataMember]
        public int type { get; set; }
        [DataMember]
        public virtual City idCity { get; set; }
        [DataMember]
        public virtual List<Location> Locations { get; set; }
        [DataMember]
        public virtual List<Message> Messages { get; set; }
        [DataMember]
        public virtual List<Like> Likes { get; set; }
        [DataMember]
        public virtual List<UserImage> UserImages { get; set; }
        [DataMember]
        public virtual List<Preference> Preferences { get; set; }
    }
}