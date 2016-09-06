using System;
using System.Collections.Generic;
using System.ServiceModel;
using System.ServiceModel.Web;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    [ServiceContract]
    public interface ICityService : IDisposable
    {
        [OperationContract]
        [WebInvoke(Method = "POST",
            ResponseFormat = WebMessageFormat.Json,
            RequestFormat = WebMessageFormat.Json,
            BodyStyle = WebMessageBodyStyle.Wrapped,
            UriTemplate = "")]
        City Add(City city);

        [OperationContract]
        [WebInvoke(Method = "PUT",
                    ResponseFormat = WebMessageFormat.Json,
                    RequestFormat = WebMessageFormat.Json,
                        BodyStyle = WebMessageBodyStyle.Bare,
                        UriTemplate = "")]
        City Update(City city);

        [OperationContract]
        [WebInvoke(Method = "GET",
                    ResponseFormat = WebMessageFormat.Json,
                    RequestFormat = WebMessageFormat.Json,
                        BodyStyle = WebMessageBodyStyle.Wrapped,
                        UriTemplate = "/{id}")]
        City GetById(Guid id);

        [OperationContract]
        [WebInvoke(Method = "GET",
            ResponseFormat = WebMessageFormat.Json,
            RequestFormat = WebMessageFormat.Json,
                BodyStyle = WebMessageBodyStyle.Wrapped,
                UriTemplate = "")]
        IEnumerable<City> GetAll();

        [OperationContract]
        [WebInvoke(Method = "DELETE",
                    ResponseFormat = WebMessageFormat.Json,
                    RequestFormat = WebMessageFormat.Json,
                        BodyStyle = WebMessageBodyStyle.Bare,
                        UriTemplate = "/{id}")]
        void Remove(Guid id);

    }
}